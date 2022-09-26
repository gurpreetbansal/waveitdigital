<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\RazorPayTrait;
use App\RazorpaySubscription;
use App\RazorpayInvoice;
use App\Coupon;
use Mail;


class WebhookController extends Controller {

	use RazorPayTrait;

	public function getResponse(){
		$body = @file_get_contents('php://input');
		$event_json = json_decode($body,true);
		return $event_json;
	}

	public function rp_postback_webhooks(){
		$response = $this->getResponse();

		if(!empty($response))
		{
			switch ($response['event']) {

				case 'payment_link.paid':				
				return $this->paymentLinkPaid($response);

				case 'payment_link.expired':				
				return $this->paymentLinkExpired($response);

				case 'payment_link.cancelled':				
				return $this->paymentLinkExpired($response);

			}
		}	
	}


	private function paymentLinkPaid($response){
		file_put_contents(dirname(__FILE__).'/webhook_logs/paymentLinkPaid.txt',print_r($response,true));

		$invoice_entity = $response['payload']['payment_link']['entity'];
		$invoice_count =  0;
		$subscription = RazorpaySubscription::with('userDetail')->where('payment_link_id',$invoice_entity['id'])->first();

		RazorpaySubscription::where('id',$subscription->id)->update([
			'payment_status'=>$invoice_entity['status'],
			'payment_link_id'=>NULL,
			'payment_link'=>NULL,
			'response'=>json_encode($response,true)
		]);

		$invoice = RazorpayInvoice::where('user_id',$subscription->user_id)->get();

		$string = 'AD-'.strtoupper(substr($subscription->userDetail->company_name, 0, 3));
		if(count($invoice) > 0){
			$invoice_number = RazorpayInvoice::generate_invoice_number(count($invoice),$string);
		}else{
			$invoice_number = RazorpayInvoice::generate_invoice_number(0,$string);
		}


		$start_date = date('Y-m-d',strtotime('+1 day',strtotime($subscription->current_period_start)));
		$end_date = date('Y-m-d',strtotime('+'.$subscription->subscription_interval,strtotime($start_date)));

		RazorpayInvoice::create([
			'user_id'=>$subscription->user_id,
			'razorpay_subscription_id'=>$subscription->id,
			'package_id'=>$subscription->plan_id,
			'amount'=> $subscription->amount,
			'subscription_interval' => $subscription->subscription_interval,
			'current_period_start' => $start_date,
			'current_period_end' => $end_date,
			'invoice_number'=> $invoice_number,
			'invoice_date'=>date("Y-m-d"),
			'order_id'=> $invoice_entity['order_id'],
			'invoice_status'=> $invoice_entity['status']
		]);

		User::where('id',$subscription->user_id)->update([
			'subscription_status' => 1,
			'subscription_ends_at' => $end_date
		]);

		self::send_invoice($subscription->user_id,$subscription->id,$subscription->plan_id);
	}

	private function paymentLinkExpired($response){
		file_put_contents(dirname(__FILE__).'/webhook_logs/paymentLinkExpired.txt',print_r($response,true));

		$subscription = RazorpaySubscription::with('userDetail')->where('payment_link_id',$payment_link_data['id'])->first();

		RazorpaySubscription::where('id',$subscription->id)->update([
			'payment_status' => 'canceled',
			'canceled_at' => now()
			'payment_link_id'=>NULL,
			'payment_link'=>NULL,
			'canceled_response'=>json_encode($response,true)
		]);

		User::where('id',$subscription->user_id)->update([
			'subscription_status' => 0,
			'subscription_ends_at' => now()
		]);

		self::subscription_cancel_email($subscription->user_id,$subscription->id);
	}


	public function send_invoice($user_id,$subscription_id,$plan_id) {
		try{
			$subscription_data = RazorpaySubscription::where('id',$subscription_id)->where('plan_id',$plan_id)->first();

			$user_detail = User::with('UserAddress')->where('id',$user_id)->first();

			$package_detail = Package::where('id',$plan_id)->first();

			$invoice = RazorpayInvoice::where('razorpay_subscription_id',$subscription_id)->first();

			$package_name = $package_detail->name .' Plan';

			$discounted_value = $amount_paid = 0.00;

			$data = array(
				'email' => $user_detail->email,
				'account_name' => $user_detail->name,
				'amount_paid' => $amount_paid,
				'invoice_number' => '',
				'description' => $package_name .' -  Subscription',
				'start' => date("Y-m-d", strtotime($subscription_data->current_period_start)),
				'end' => date("Y-m-d", strtotime($subscription_data->current_period_end)),
				'city' => $user_detail->UserAddress->city,
				'country' => $user_detail->UserAddress->country,
				'line1' => $user_detail->UserAddress->line1,
				'line2' => $user_detail->UserAddress->line2,
				'postal_code' => $user_detail->UserAddress->zip,
				'discounted_value' => $discounted_value,
				'from' => \config('app.MAIL_FROM_NAME'),
				'package_name'=>$package_name,
				'package_price'=>$subscription_data->amount,
				'invoice_number'=> $invoice->invoice_number,
				'invoice_date'=> $invoice->invoice_date
			);

			\Mail::send(['html' => 'mails/front/rp_subscription_invoice'], $data, function($message) use($data) {
				$message->to($data['email'], $data['account_name'])->subject('Invoice (Razorpay Dev) - Agency Dashboard!');
				$message->from(\config('app.mail'), 'Agency Dashboard');
			});
		}catch(Exception $e){

		}
	}


	public function subscription_cancel_email($user_id,$subscription_id){
		try{
			$user = User::where('id', $user_id)->first();
			$user_package = UserPackage::with('package')->where('user_id',$user_id)->latest()->first();
			$data = array('name' => $user->name, 'package_name' => $user_package->package->name,'package_price'=>$user_package->price,'package_type'=>$user_package->subscription_type);

			\Mail::send(['html' => 'mails/vendor/subscription_cancellation'], $data, function($message) use($user) {
				$message->to($user->email, $user->name)
				->subject('Your membership at Agency Dashboard has been CANCELLED');
				$message->from(\config('app.mail'), 'Agency Dashboard');
			});


			//admin
			$admin = User::where('role_id', 1)->first();
			$admin_data = array('name' => $user->name, 'package_name' => $user_package->package->name,'package_price'=>$user_package->price,'package_type'=>$user_package->subscription_type,'subscription_id'=>$subscription_id);

			\Mail::send(['html' => 'mails/vendor/admin_subscription_cancellation'], $admin_data, function($admin_message) use($admin) {
				$admin_message->to($admin->email, $admin->name)
				->subject('Subscription Cancelled');
				$admin_message->from(\config('app.mail'), 'Agency Dashboard');
			});
		}catch(Exception $e){
			//return $e->getMessage();
		}
	}

}