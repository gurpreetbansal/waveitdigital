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

	public function __construct(){
		// $this->key_id =  \config('app.RAZORPAY_KEY_ID');
		// $this->secret = \config('app.RAZORPAY_KEY_SECRET');	
		
		$this->key_id =  'rzp_test_wWDvis1ViDOZjn';
		$this->secret = 'f6uhFBI95pDKlDB1Q9QYC3lY';


		// $this->key_id = 'rzp_live_uXDe2iy31ntQrr';
		// $this->secret = '1V907hDFVQduB3V4pQCWjNgb';
	}


	public function initiate_subscriptions(Request $request){
		$string = base64_decode($request->registeration_data);
		$explode = explode('+',$string);
		
		$coupon_code = $coupon = '';
		$coupon_id = 0;

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

			$start_date = strtotime('+1 day',strtotime(now()));
			$invoicing_date = strtotime('-1 day',$start_date);
			$end_date = strtotime("+ ".$interval, $start_date);
			$reminder_date = strtotime("+1 day", $end_date);

			$save_subscription = RazorpaySubscription::create(
				[
					'user_id' =>$user->id,
					'plan_id' =>$package->id,
					'amount'=> $package_amount,
					'subscription_interval' =>$interval,
					'current_period_start' => date('Y-m-d H:i:s',$start_date),
					'current_period_end' => date('Y-m-d H:i:s', $end_date),
					'discount'=>NULL,
					'trial_ends_at'=>date('Y-m-d H:i:s',$start_date),
					'next_invoice_on'=>date('Y-m-d',$invoicing_date),
					'reminder_on'=>date('Y-m-d',$reminder_date),
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
				// RazorpaySubscription::registeration($user->id);
				// RazorpaySubscription::email_verification($user->id);
				//$this->trial_invoice($user->id,$save_subscription->id,$package->id);
				return redirect('/thankyou');
			}			
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
			'start' => date("Y-m-d", $subscription_data->current_period_start),
			'end' => date("Y-m-d", $subscription_data->current_period_end),
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


	public function cron_for_payment_link(){
		$check_date = date('Y-m-d',strtotime('+1 day'));
		$get_data = RazorpaySubscription::with('userDetail')->where('next_invoice_on',$check_date)->get();
		if(isset($get_data) && !empty($get_data)){
			foreach($get_data as $value){

				$package_details = Package::where('id',$value->plan_id)->first();

				$post_data = array(
					'amount' => $value->package_amount*100,
					'currency' => 'USD',
					'description' => $package_details->name .' - Subscription',
					'customer_name'=>$value->userDetail->name,
					'customer_email'=>$value->userDetail->email,
					'customer_contact'=>$value->userDetail->phone,
					'callback_url'=>url('/'),
					'callback_method'=>'get'
				);

				$create_payment_link = $this->create_payment_link($post_data);

				if($create_payment_link->status == 'created'){
					RazorpaySubscription::where('id',$value->id)->update([
						'payment_link_id'=>$create_payment_link->id,
						'payment_link' => $create_payment_link->short_url
					]);
				}				
			}
		}
	}


	public function initiate_subscriptions_bkp(Request $request){	
		echo "<pre>";
		print_r($request->all());
		die;

		$coupon_code = $coupon = '';
		$coupon_id = 0;
		if($request['existing_user'] !='' && !empty($request['existing_user'])){
			$decode_data = base64_decode($request['data-key']);
			$explode = explode('+',$decode_data);
			$email = $explode[0];
			$company = $explode[1];
			$vanity_url = $explode[2];
			$package_id = $explode[3];
			$package_state = $explode[4];
			$user_id = $explode[5];

			$user_data = User::where('id',$user_id)->first();
			$subscription = RazorpaySubscription::where('user_id',$user_id)->latest()->first();
			$cancel_previous_plan = $this->cancel_a_subscription($subscription->subscription_id,0);
			if($cancel_previous_plan->status == 'cancelled'){
				RazorpaySubscription::where('subscription_id',$subscription_id)->where('user_id',$user_id)->update([
					'canceled_at'=>date('Y-m-d H:i:s',$cancel_previous_plan->ended_at),
					'ends_at'=>date('Y-m-d H:i:s',$cancel_previous_plan->current_end),
					'stripe_status'=>$cancel_previous_plan->status,
					'cancel_response'=>json_encode($cancel_previous_plan,true)
				]);

				User::where('id',$user_id)->update([
					'subscription_ends_at'=>date('Y-m-d H:i:s',$cancel_previous_plan->current_end),
					'subscription_status'=>0
				]);

				RazorpaySubscription::send_cancelled_email($user_data);
			}

			$package = Package::find($package_id);

			if($package_state  == 'month'){
				$total_count = '12';
				$planID = $package->rp_monthly_id;
				$amount = $package->monthly_amount;
			}else{
				$total_count = '1';
				$planID = $package->rp_yearly_id;
				$amount = ($package->yearly_amount*12);
			}

			if($coupon_code <> null && !empty($coupon_code)){
				$coupon_data = Coupon::where('code',$request->coupon_code)->first();
				$coupon = $coupon_data->rp_coupon_code_id;
				$discounted_value = RazorpaySubscription::calculate_discount($package_amount,$coupon_data);
				$subscriptionData = array(
					'plan_id' => $planID,
					'customer_notify' => 0,
					'total_count' => $total_count,
					'offer_id'=>$coupon
				);
			}else{
				$discounted_value = 0.00;
				$subscriptionData = array(
					'plan_id' => $planID,
					'customer_notify' => 0,
					'total_count' => $total_count
				);
			}

			$ch = $this->get_curl_handle_subscriptions($subscriptionData);
			$result = curl_exec($ch);
			$data = json_decode($result);



			$subscription_session =	[
				'user_id'=>$user_id,
				'subscription_id' => $data->id,
				'plan_id' => $data->plan_id,
				'charge_at' => $data->charge_at,
				'start_at' => $data->start_at,
				'end_at' => $data->end_at,
				'offer_id' => $data->offer_id,
				'total_count' => $data->total_count,
				'remaining_count' => $data->remaining_count,
				'subscription_created_date' => $data->created_at,
				'short_url' => $data->short_url,
				'package'=>$package->name,
				'amount'=>$amount,
				'password'=>$password,
				'company'=>$company,
				'vanity_url'=>$vanity_url,
				'package_state'=>$package_state,
				'interval'=>$interval,
				'discounted_value'=>$discounted_value
			];

			Session::put('subscription_session', $subscription_session);
			return response()->json($subscription_session);
		}else{
			$string = base64_decode($request->registeration_data);
			$explode = explode('+',$string);

			$coupon_code = $coupon = '';
			$coupon_id = 0;

			$email = $explode[0];
			$password = $explode[1];
			$company = $explode[2];
			$vanity_url = $explode[3];
			$package_id = $explode[4];
			$package_state = $explode[5];
			$coupon_code = $explode[6];



			$package = Package::find($package_id);
			$start_date = strtotime('+1 days',strtotime(now()));

			if($package_state  == 'month'){
				$total_count = '12';
				$planID = $package->rp_monthly_id;
				$package_amount = $package->monthly_amount;
				$interval = '1 month';
			}else{
				$total_count = '1';
				$planID = $package->rp_yearly_id;
				$package_amount = ($package->yearly_amount*12);
				$interval = '1 year';
			}

			if($coupon_code <> null && !empty($coupon_code)){
				$coupon_data = Coupon::where('code',$request->coupon_code)->first();  //need to check once 
				$coupon = $coupon_data->rp_coupon_code_id;
				$discounted_value = RazorpaySubscription::calculate_discount($package_amount,$coupon_data);

				$subscriptionData = array(
					'plan_id' => $planID,
					'customer_notify' => 0,
					'total_count' => $total_count,
					'start_at'=>$start_date, /*to start subscription immediately */
					'offer_id'=>$coupon
				);
			}else{
				$coupon = '';
				$discounted_value = 0.00;
				$subscriptionData = array(
					'plan_id' => $planID,
					'customer_notify' => 0,
					'total_count' => $total_count,
					'start_at'=>$start_date
				);
			}


			// $subscriptionData = array(
			// 	'plan_id' => 'plan_JT7MWT10EppCl0',
			// 	'customer_notify' => 0,
			// 	'total_count' => 1,
			// 	'start_at'=>$start_date, /*to start subscription immediately */
			// 	'offer_id'=>'offer_JT0vdmwei7u43L'
			// );

			$ch = $this->get_curl_handle_subscriptions($subscriptionData);
			$result = curl_exec($ch);
			$data = json_decode($result);

			echo "<pre>";
			print_r($data);
			die;
			
			$subscription_session =	[
				'subscription_id' => $data->id,
				'plan_id' => $data->plan_id,
				'charge_at' => $data->charge_at,
				'start_at' => $data->start_at,
				'end_at' => $data->end_at,
				'offer_id' => $coupon,
				'total_count' => $data->total_count,
				'remaining_count' => $data->remaining_count,
				'subscription_created_date' => $data->created_at,
				'short_url' => $data->short_url,
				'package'=>$package->name,
				'amount'=>$package_amount,
				'password'=>$password,
				'company'=>$company,
				'vanity_url'=>$vanity_url,
				'package_state'=>$package_state,
				'interval'=>$interval,
				'discounted_value'=>$discounted_value
			];

			Session::put('subscription_session', $subscription_session);
			return response()->json($subscription_session);
		}
	}

	public function initiate_subscriptions_old(Request $request){	
		$create_payment_link = $this->create_payment_link();
		echo "<pre>";
		print_r($create_payment_link);
		die;
		
		$string = base64_decode($request->registeration_data);
		$explode = explode('+',$string);

		$coupon_code = $coupon = '';
		$coupon_id = 0;

		$email = $explode[0];
		$password = $explode[1];
		$company = $explode[2];
		$vanity_url = $explode[3];
		$package_id = $explode[4];
		$package_state = $explode[5];
		$coupon_code = $explode[6];

		if($coupon_code <> null){
			$package = Package::where('parent_id',$package_id)->where('coupon_code',$coupon_code)->first();
		}else{
			$package = Package::find($package_id);
		}

		$start_date = strtotime('+1 day',strtotime(now()));

		if($package_state  == 'month'){
			$total_count = '12';
			$planID = $package->rp_monthly_id;
			$package_amount = $package->monthly_amount;
			$interval = '1 month';
		}else{
			$total_count = '1';
			$planID = $package->rp_yearly_id;
			$package_amount = ($package->yearly_amount*12);
			$interval = '1 year';
		}


		$subscriptionData = array(
			'plan_id' => $planID,
			'customer_notify' => 0,
			'total_count' => $total_count,
			'start_at'=>$start_date
		);

		$ch = $this->get_curl_handle_subscriptions($subscriptionData);
		$result = curl_exec($ch);
		$data = json_decode($result);

		//$discounted_value = '5';
		
		$subscription_session =	[
			'subscription_id' => $data->id,
			'plan_id' => $data->plan_id,
			'charge_at' => $data->charge_at,
			'start_at' => $data->start_at,
			'end_at' => $data->end_at,
			//'offer_id' => $coupon,
			'total_count' => $data->total_count,
			'remaining_count' => $data->remaining_count,
			'subscription_created_date' => $data->created_at,
			'short_url' => $data->short_url,
			'package'=>$package->name,
			'amount'=>$package_amount,
			'password'=>$password,
			'company'=>$company,
			'vanity_url'=>$vanity_url,
			'package_state'=>$package_state,
			'interval'=>$interval
		];

		Session::put('subscription_session', $subscription_session);
		return response()->json($subscription_session);

	}

	private function get_curl_handle_subscriptions($subscriptionData) {
		$url = 'https://api.razorpay.com/v1/subscriptions';
		$key_id = $this->key_id;
		$key_secret = $this->secret;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POST, 1);
		$params = http_build_query($subscriptionData);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		return $ch;
	}

	public function create_subscription(Request $request){
		$subscription_session = Session::get('subscription_session');

		// $order_data = array(
		// 	'receipt_id' => 'AD_'.time(),
		// 	'amount'=> 14900
		// );

		// $order = $this->createAnOrder($order_data);	


		// if(!empty($order) && $order->status == 'created'){
		// 	$order_id = $order->id;


		$surl = url('/').'/thankyou';
		$furl = url('/').'/rp-failure';
		$return_url = url('/').'/callbacksubscriptions';
		$package_id = $request->package_id;

		$payInfo = array(
			'txnid' => time(),
			'card_holder_name' => $request->billing_name,
			'email' => $request->billing_email,
			'phone' => $request->billing_phone,
			'address_line_1' => $request->address_line_1,
			'address_line_2' => $request->address_line_2,
			'city' => $request->city,
			'country' => $request->country,
			'postal_code' => $request->postal_code,
			'coupon_code' => $request->coupon_code,
			'productinfo' => $package_id,
			'surl' => $surl,
			'furl' => $furl,
			'currency_code' => 'INR',
			// 'currency_code' => 'USD',
			'order_id' => 'AD_'.time(),
			'return_url' => $return_url,
			'payment_type' => 'create_subscriptions',
			'subscription_id' => $subscription_session['subscription_id'],
			'plan_id' => $subscription_session['plan_id'],
			'amount' => $subscription_session['amount'],
			'package' => $subscription_session['package'],
			'subscription_session' => $subscription_session,
			'password'=>$subscription_session['password'],
			'company'=>$subscription_session['company'],
			'vanity_url'=>$subscription_session['vanity_url'],
			'short_url' => $subscription_session['short_url'],
			'package_state'=>$subscription_session['package_state']
		);

		Session::put('payment_info', $payInfo);
		if(isset($subscription_session['user_id'])){
			Session::push('payment_info.user_id',$subscription_session['user_id']);
		}
		return view('front.razorpayform',compact('payInfo'));

		// }else{
		// 	$response['status'] = 'error';
		// 	return response()->json($response);
		// }
	}

	public function callbacksubscriptions(Request $request) {

		// $attributes = [
		// 	'razorpay_signature'=>$request['razorpay_signature'],
		// 	'razorpay_payment_id'=>$request['razorpay_payment_id'],
		// 	'razorpay_order_id'=>$request['razorpay_order_id']
		// ];
		// $verify = $this->verifySignature($attributes);

		// echo '<pre>';
		// print_r($verify);
		// die('shruti');
		$payment_info = Session::get('payment_info');

		if (!empty($request->razorpay_payment_id) && !empty($request->merchant_order_id)) {
			$error = '';

			try {
				$final_data = array(
					'transaction_id' => $request->merchant_trans_id,
					'card_holder_name' => $request->card_holder_name_id,
					'surl' => $request->merchant_surl_id,
					'furl' => $request->merchant_furl_id,
					'order_id' => $request->merchant_order_id,
					'payment_id' => $request->razorpay_payment_id,
					'subscription_id' => $request->merchant_subscription_id,
					'merchant_amount' => ($request->merchant_amount)/100,
					'plan_code' => $request->merchant_plan_id,
					'plan_id' => $request->merchant_product_info_id,
					'created_at' => time()
				);

				$this->store_payment_data($payment_info,$final_data);
			} catch (Exception $e) {

			}		
		} else {
			echo 'An error occured. Contact site administrator, please!';
		}
	}

	private function store_payment_data($payment_info,$final_data){
		$card_details = $this->fetch_card_details($final_data['payment_id']);
		$payment_details = $this->fetch_payment_detils($final_data['payment_id']);

		file_put_contents(dirname(__FILE__).'/rp_logs/payment_details.json',print_r($payment_details,true));
		file_put_contents(dirname(__FILE__).'/rp_logs/final_data.txt',print_r($final_data,true));

		$user_array = [
			'name' => ucwords($payment_info['card_holder_name']),
			'email'=>$payment_info['email'],
			'password'=>Hash::make($payment_info['password']),
			'role'=>'front',
			'role_id'=>'2',
			'company_name'=>strtolower(str_replace(' ','',$payment_info['vanity_url'])),
			'company'=>trim($payment_info['company']),
			'stripe_id' => $payment_details['customer_id'],
			'card_brand'=>$card_details['network'],
			'card_last_four'=>$card_details['last4'],
			'purchase_mode'=>2,
         //	'referer'=>Session::get('user_referer')
		];

		if(isset($payment_info['user_id'])){
			$user = User::where('id',$payment_info['user_id'])->update($user_array);
		}else{
			$user = User::create($user_array);
		}

		if ($user) {
			$email_token = base64_encode($user->created_at.$user->id);
			User::where('id',$user->id)->update(['email_verification_token'=>$email_token,'email_sent_at'=>now()]);

			$package = Package::package_details($payment_info['productinfo'],'razorpay',$payment_info['package_state']);


			UserPackage::create([
				'user_id' => $user->id,
				'package_id' => $package['package']->id,
				'projects' => $package['package']->number_of_projects,
				'keywords' => $package['package']->number_of_keywords,
				'flag' => '1',
				'trial_days' => $package['package']->duration ?: 0,
				'price'=>$package['amount'],
				'subscription_type'=>$payment_info['package_state'],
				'package_purchase' => 1
			]);

			UserAddress::create([
				'user_id' => $user->id,
				'address_line_1' => $payment_info['address_line_1'],
				'address_line_2' => $payment_info['address_line_2'],
				'city' => $payment_info['city'],
				'country' => $payment_info['country'],
				'zip' => $payment_info['postal_code']
			]);

			UserCredit::create([
				'user_id' => $user->id,
				'package_credit' => $package['package']->site_audit_page
			]);

			$save_subscription = RazorpaySubscription::create(
				[
					'user_id' =>$user->id,
					'plan_id' =>$package['package']->id,
					'subscription_id' =>$final_data['subscription_id'],
					'payment_id' =>$final_data['payment_id'],
					'customer_id' =>$payment_details['customer_id'],
					'order_id'=>$payment_details['order_id'],
					'amount'=>($payment_details['amount'])/100,
					'invoice_id'=>$payment_details['invoice_id'],
					'card_id'=>$payment_details['card_id'],
					'subscription_interval' =>$payment_info['subscription_session']['interval'],
					'current_period_start' =>$payment_info['subscription_session']['start_at'],
					'current_period_end' => strtotime("+ ".$payment_info['subscription_session']['interval'], $payment_info['subscription_session']['charge_at']),
					'subscription_created_date' =>$payment_info['subscription_session']['subscription_created_date'],
					'discount'=>NULL,
					//'coupon_name'=>$payment_info['subscription_session']['offer_id'],
					'total_count'=>$payment_info['subscription_session']['total_count'],
					'remaining_count'=>$payment_info['subscription_session']['remaining_count'],
					'short_url'=>$payment_info['subscription_session']['short_url'],
					'trial_ends_at'=>date('Y-m-d H:i:s',$payment_info['subscription_session']['start_at']),
					'payment_status'=>$payment_details['status'],
					'payment_response'=>json_encode($payment_details,true)
				]
			);

			Session::forget(['subscription_session','payment_info']);
			if(!isset($payment_info['subscription_session']['user_id'])){
				Auth::loginUsingId($user->id);
				// RazorpaySubscription::registeration($user->id);
				// RazorpaySubscription::email_verification($user->id);
				// $this->trial_invoice($user->id,$final_data['subscription_id']);
			}			
			return redirect($final_data['surl']);
		}
	}


}