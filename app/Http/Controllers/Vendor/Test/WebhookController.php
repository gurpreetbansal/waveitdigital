<?php

namespace App\Http\Controllers\Vendor\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscription;
use App\SubscriptionItem;
use App\User;
use App\Invoice;
use App\InvoiceItem;
use Mail;
use App\Package;

class WebhookController extends Controller {

	public function check_invoice_email(){
		$this->send_invoice();
	}

	public function send_invoice() {
		//$stripe = new \Stripe\StripeClient('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');
		// $invoice_response = $stripe->invoices->all(['customer' => $customer_id,'subscription' => $subscription_id]);
		// $invoice_data =  $invoice_response->data;

		// file_put_contents(dirname(__FILE__).'/invoice_data.json',print_r(json_encode($invoice_data,true),true));
		$url = env('FILE_PATH').'/app/Http/Controllers/Vendor/Test/invoice_data.json'; 
		$data = file_get_contents($url);
		$final = json_decode($data);
		$invoice_data = reset($final);
		


		$string = $invoice_data->lines->data[0]->plan->id;
		$field = ['stripe_price_id','stripe_price_yearly_id'];
		$package_detail = Package::
		where(function ($query) use($string, $field) {
			for ($i = 0; $i < count($field); $i++){
				$query->orwhere($field[$i], 'LIKE',  '%' . $string .'%');
			}      
		})
		->first();
		//dd($invoice_data);

		$package_name = 'Agency Plan';
		$package_price = ($invoice_data->lines->data[0]->plan->amount)/100;

		$discounted_value = 0.00;
		if(!empty($invoice_data->total_discount_amounts)){
			$discounted_value =  number_format(($invoice_data->total_discount_amounts[0]->amount/100),2);
		}



		$data = array(
			'email' => 'shruti.dhiman@imarkinfotech.com',
			'account_name' => $invoice_data->customer_shipping->name,
			'amount_paid' => ($invoice_data->amount_paid)/100,
			'invoice_number' => $invoice_data->number,
			'description' => $invoice_data->lines->data[0]->description,
			'start' => gmdate("Y-m-d", $invoice_data->lines->data[0]->period->start),
			'end' => gmdate("Y-m-d", $invoice_data->lines->data[0]->period->end),
			'city' => $invoice_data->customer_address->city,
			'country' => $invoice_data->customer_address->country,
			'line1' => $invoice_data->customer_address->line1,
			'line2' => $invoice_data->customer_address->line2,
			'postal_code' => $invoice_data->customer_address->postal_code,
			'discounted_value' => $discounted_value,
			'from' => \config('app.MAIL_FROM_NAME'),
			'package_name'=>$package_name,
			'package_price'=>$package_price,
			'status'=>$invoice_data->status,
			'next_payment_attempt'=>$invoice_data->next_payment_attempt
			
		);


		\Mail::send(['html' => 'mails/front/subscription_invoice_test'], $data, function($message) use($data) {
			$message->to('shruti.dhiman@imarkinfotech.com', 'Shruti Dhiman')->subject('Invoice - Agency Dashboard!');
			$message->from(\config('app.mail'), 'Agency Dashboard');
		});


		if (\Mail::failures()) {
			return redirect()->back()->withErrors(['error' => 'Error sending email']);
		} else {
			return true;
		}
	} 
}