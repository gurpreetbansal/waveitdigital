<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Razorpay\Api\Api;
use App\Traits\RazorPayTrait;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
use App\Package;
use App\Coupon;
use App\User;
use App\UserPackage;
use App\UserAddress;
use App\UserCredit;
use App\RazorpaySubscription;
use App\RazorpayInvoice;


class RazorpayController extends Controller {

	use RazorPayTrait;

	public function initiate_subscriptions(Request $request){
		$string = base64_decode($request->registeration_data);
		$explode = explode('+',$string);
		
		$coupon_code = $coupon = '';
		$coupon_id = 0; $discounted_amount =  0;

		$email = $explode[0];
		$password = $explode[1];
		$company = $explode[2];
		$vanity_url = $explode[3];
		$package_id = $explode[4];
		$package_state = $explode[5];
		$coupon_code = $explode[6];

		$package = Package::find($package_id);
		if($package_state  == 'month'){
			$package_amount = $package->monthly_amount;
			$interval = '1 month';
		}else{
			$package_amount = ($package->yearly_amount*12);
			$interval = '1 year';
		}

		if(!empty($coupon_code) && $coupon_code <> null){
			$coupon_data = Coupon::where('code',$coupon_code)->first();
			$discount_calculation = $this->calculate_discount($package_amount,$coupon_data);
			$package_amount = $discount_calculation['after_discount'];
			$discounted_amount = $discount_calculation['discounted_amount'];
		}

		$user_array = [
			'name' => ucwords($request->billing_name),
			'email'=>$request->billing_email,
			'phone'=>$request->billing_phone,
			'password'=>Hash::make($password),
			'role'=>'front',
			'role_id'=>'2',
			'company_name'=>strtolower(str_replace(' ','',$vanity_url)),
			'company'=>trim($company),
			'purchase_mode'=>2
		];

		$user = User::create($user_array);

		if ($user) {
			$email_token = base64_encode($user->created_at.$user->id);
			User::where('id',$user->id)->update(['email_verification_token'=>$email_token,'email_sent_at'=>now()]);

			UserPackage::create([
				'user_id' => $user->id,
				'package_id' => $package_id,
				'projects' => $package->number_of_projects,
				'keywords' => $package->number_of_keywords,
				'flag' => '1',
				'trial_days' => $package->duration ?: 0,
				'price'=>$package_amount,
				'subscription_type'=>$package_state,
				'package_purchase' => 1
			]);

			UserAddress::create([
				'user_id' => $user->id,
				'address_line_1' => $request->address_line_1,
				'address_line_2' => $request->address_line_2,
				'city' => $request->city,
				'country' => $request->country,
				'zip' => $request->postal_code
			]);

			UserCredit::create([
				'user_id' => $user->id,
				'package_credit' => $package->site_audit_page
			]);

			$start_date = strtotime(now());
			$end_date = strtotime('+2 day',$start_date);
			$invoicing_date = strtotime('-1 day',$end_date);
			$reminder_date_1 = strtotime("+1 day", $end_date);
			$reminder_date_2 = strtotime("+3 day", $end_date);
			$reminder_date_3 = strtotime("+5 day", $end_date);

			$save_subscription = RazorpaySubscription::create(
				[
					'user_id' => $user->id,
					'plan_id' => $package->id,
					'amount'=> $package_amount,
					'subscription_interval' => $interval,
					'current_period_start' => date('Y-m-d H:i:s',$start_date),
					'current_period_end' => date('Y-m-d H:i:s', $end_date),
					'discount'=>$discounted_amount,
					'trial_ends_at'=> date('Y-m-d H:i:s',$end_date),
					'next_invoice_on'=> date('Y-m-d',$invoicing_date),
					'reminder_on_1'=> date('Y-m-d',$reminder_date_1),
					'reminder_on_2'=> date('Y-m-d',$reminder_date_2),
					'reminder_on_3'=> date('Y-m-d',$reminder_date_3),
					'payment_status'=> 'trialing',
					'payment_link_id'=>NULL,
					'payment_link' => NULL
				]
			);

			RazorpayInvoice::create([
				'user_id'=>$user->id,
				'razorpay_subscription_id'=>$save_subscription->id,
				'package_id'=>$package->id,
				'amount'=> $package_amount,
				'subscription_interval' =>$interval,
				'current_period_start' => date('Y-m-d H:i:s',$start_date),
				'current_period_end' => date('Y-m-d H:i:s',$end_date),
				'invoice_number'=>'AD-'.strtoupper(substr($company, 0, 3)).'-0001',
				'invoice_date'=>date("Y-m-d"),
				'invoice_status'=> 'paid'
			]);

			if($save_subscription->id){
				Auth::loginUsingId($user->id);
				RazorpaySubscription::registeration($user->id);
				RazorpaySubscription::email_verification($user->id);
				$this->trial_invoice($user->id,$save_subscription->id,$package->id);

				$response['status'] = 1;
				$response['url'] = 'thankyou';
			}else{
				$response['status'] = 0;
			}			
			return response()->json($response);
		}		
	}

	public function trial_invoice($user_id,$subscription_id,$plan_id) {
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

		\Mail::send(['html' => 'mails/front/subscription_invoice_trial'], $data, function($message) use($data) {
			$message->to($data['email'], $data['account_name'])->subject('Invoice (Razorpay Dev) - Agency Dashboard!');
			$message->from(\config('app.mail'), 'Agency Dashboard');
		});
	}

	public function renew_razorpay_subscription(Request $request){
		$user = User::where('id',$request->user_id)->first();

		$package = Package::find($request->package_id);
		if($request->package_type  == 'month'){
			$package_amount = $package->monthly_amount;
			$interval = '1 month';
		}else{
			$package_amount = ($package->yearly_amount*12);
			$interval = '1 year';
		}

		UserPackage::create([
			'user_id' => $request->user_id,
			'package_id' => $package->id,
			'projects' => $package->number_of_projects,
			'keywords' => $package->number_of_keywords,
			'flag' => '1',
			'trial_days' => 0,
			'price'=>$package_amount,
			'subscription_type'=>$request->package_type,
			'package_purchase' => 1
		]);


		UserCredit::create([
			'user_id' => $user->id,
			'package_credit' => $package->site_audit_page
		]);

		$start_date = strtotime(now());
		$end_date = strtotime('+ '.$interval,$start_date);
		$invoicing_date = strtotime('-1 day',$end_date);
		$reminder_date_1 = strtotime("+1 day", $end_date);
		$reminder_date_2 = strtotime("+3 day", $end_date);
		$reminder_date_3 = strtotime("+5 day", $end_date);

		$save_subscription = RazorpaySubscription::create(
			[
				'user_id' => $user->id,
				'plan_id' => $package->id,
				'amount'=> $package_amount,
				'subscription_interval' => $interval,
				'current_period_start' => date('Y-m-d H:i:s',$start_date),
				'current_period_end' => date('Y-m-d H:i:s', $end_date),
				'discount'=>NULL,
				'trial_ends_at'=> date('Y-m-d H:i:s',$end_date),
				'next_invoice_on'=> date('Y-m-d',$invoicing_date),
				'reminder_on_1'=> date('Y-m-d',$reminder_date_1),
				'reminder_on_2'=> date('Y-m-d',$reminder_date_2),
				'reminder_on_3'=> date('Y-m-d',$reminder_date_3),
				'payment_status'=> 'trialing',
				'payment_link_id'=>NULL,
				'payment_link' => NULL
			]
		);

		$post_data = array(
			'amount' => $package_amount*100,
			'currency' => 'USD',
			'description' => $package->name .' - Subscription',
			'customer_name'=> ($user)?$user->name:'',
			'customer_email'=> ($user)?$user->email:'',
			'customer_contact'=> ($user)?'+91'.$user->phone:'',
			'callback_url'=> url('/'),
			'callback_method'=> 'get',
			'expire_by'=> strtotime('+1 day',$reminder_date_3)
		);

		$create_payment_link = $this->create_payment_link($post_data);
		file_put_contents(dirname(__FILE__).'/logs/create_payment_link.txt',print_r($create_payment_link,true));

		if($create_payment_link->status == 'created'){
			RazorpaySubscription::where('id',$save_subscription->id)->update([
				'payment_link_id'=>$create_payment_link->id,
				'payment_link' => $create_payment_link->short_url,
				'payment_status' => 'past due'
			]);
			$response['status'] = 1;
		}else{
			$response['status'] = 0;
		}			
		return response()->json($response);
	}

	private function calculate_discount($package_amount,$coupon_data){
		$percent = $coupon_data->value;

		$calculated_value = number_format(($package_amount * $percent)/100,2);
		if($percent ==100){
			$final = 0.00;
		}
		else{
			$final = number_format(($package_amount - $calculated_value),2);
		}
		return array('after_discount'=>$final,'discounted_amount'=>$calculated_value);
	}

}