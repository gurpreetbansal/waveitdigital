<?php 

namespace App\Traits;
use Razorpay\Api\Api;

trait RazorPayTrait{

	public function __construct(){
		$this->key_id =  \config('app.TEST_RAZORPAY_KEY_ID');
		$this->secret = \config('app.TEST_RAZORPAY_KEY_SECRET');
	}


	public function fetch_card_details($paymentId){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->payment->fetch($paymentId)->fetchCardDetails();
		return $data;
	}

	public function fetch_payment_detils($paymentId){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->payment->fetch($paymentId);
		return $data;
	}

	public function fetch_subscription($subscriptionId){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->subscription->fetch($subscriptionId);
		return $data;
	}

	public function cancel_a_subscription($subscriptionId,$cancel_at){
		$api = new Api($this->key_id, $this->secret);
		$options = ['cancel_at_cycle_end'=>$cancel_at];
		$data = $api->subscription->fetch($subscriptionId)->cancel($options);
		return $data;
	}

	public function update_a_subscription($subscriptionId,$plan_id,$offer_id,$start_at){
		$api = new Api($this->key_id, $this->secret);
		$options = ['plan_id'=>$plan_id,'offer_id'=>$offer_id,'start_at'=>$start_at,'customer_notify'=>0];
		$data = $api->subscription->fetch($subscriptionId)->update($options);
		return $data;
	}

	public function fetch_invoice($invoice_id){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->invoice->fetch($invoice_id);
		return $data;
	}

	public function fetch_invoice_by_customer($customerId){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->invoice->all(['customer_id'=>$customerId]);
		return $data;
	}

	public function fetch_customer($customerId){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->customer->fetch($customerId);
		return $data;
	}

	public function createAnOrder($order_data){
		$api = new Api($this->key_id, $this->secret);
		$data = $api->order->create(array('receipt' => $order_data['receipt_id'], 'amount' => $order_data['amount'], 'currency' => 'USD'));
		return $data;
	}

	public function verifySignature($attributes){
		$api = new Api($this->key_id, $this->secret);
		$verified  = $api->utility->verifyPaymentSignature($attributes);
		return $verified;
	}


	public function create_payment_link($attributes){
		$api = new Api(\config('app.TEST_RAZORPAY_KEY_ID'), \config('app.TEST_RAZORPAY_KEY_SECRET'));
		$response = $api->paymentLink->create(
			array(
				'amount' => $attributes['amount'],
				'currency' => $attributes['currency'],
				'description' => $attributes['description'],
				'customer' => array(
					'name' => $attributes['customer_name'],
					'email' => $attributes['customer_email'],
					'contact'=> $attributes['customer_contact']
				),
				'notify'=>array('sms'=>true, 'email'=>true),
				'reminder_enable'=>true ,
				'callback_url' => $attributes['callback_url'],
				'callback_method'=> $attributes['callback_method'],
				'expire_by'=> $attributes['expire_by']
			)
		);
		return $response;
	}

	public function fetch_payment_link($paymentLinkId){
		$api = new Api(\config('app.TEST_RAZORPAY_KEY_ID'), \config('app.TEST_RAZORPAY_KEY_SECRET'));
		// $response = $api->paymentLink->fetch($paymentLinkId);
		// $response = $api->order->fetch('order_JZkDy4z5emPkfK')->payments();
		$response = $api->order->fetch('order_JZkDy4z5emPkfK');

		return $response;
	}

}