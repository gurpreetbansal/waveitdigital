<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Stripe;
use App\Subscription;
use App\Invoice;
use App\InvoiceItem;

class StripeCronController extends Controller {

	public function sendstripeInvoice(){
		 $days_until_due = 1; //default 9 days
		 $subscription_data = Subscription::with('userDetail')->where('next_invoice_on',date('Y-m-d'))->get();

		 if(isset($subscription_data) && !empty($subscription_data)){
		 	foreach($subscription_data as $key=>$value){

		 		$invoice_count = Invoice::where('subscription_master_id',$value->id)->get();

		 		$string = 'AD-'.strtoupper(substr($value->userDetail->company_name, 0, 3));

		 		if(count($invoice_count) > 0){
		 			$invoice_number = Invoice::generate_invoice_number(count($invoice_count),$string);
		 		}else{
		 			$invoice_number = Invoice::generate_invoice_number(0,$string);
		 		}



		 		if($value->coupon_name <> null){
		 			$coupon_name = $value->coupon_name;
		 		}else{
		 			$coupon_name = '';
		 		}


		 		$start_date = strtotime($value->current_period_end);
		 		$end_date = strtotime('+ '.$value->subscription_interval,strtotime($value->current_period_end));
		 		
		 		try{
		 			$stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
		 			$invoice_items =  $stripe->invoiceItems->create(
		 				[
		 					'customer' => $value->customer_id,
		 					'price' => $value->stripe_plan,
		 					'period'=> [
		 						'end' => $end_date,
		 						'start' => $start_date
		 					]
		 				]
		 			);

		 			if($invoice_items){
		 				$invoice_item_id = $invoice_items->id;

		 				$invoice_item_created = InvoiceItem::create([
		 					'description'=>$invoice_items->description,
		 					'amount'=>$invoice_items->amount/100,
		 					'currency'=>$invoice_items->currency,
		 					'quantity'=>1
		 				]);

		 				$invoice = $stripe->invoices->create(
		 					[
		 						'auto_advance' => false,
		 						'collection_method' => 'send_invoice',
		 						'customer' => $value->customer_id,
		 						'days_until_due' => $days_until_due
		 						// ,'discounts' => [
		 						// 	'coupon' => $coupon_name
		 						// ]									 						
		 					]
		 				);


		 				$inserId = Invoice::create([
		 					'subscription_master_id' => $value->id,
		 					'invoice_id' => $invoice->id,
		 					'subscription_id' => NULL,
		 					'invoice_number' => $invoice_number,
		 					'customer_id'=>$value->customer_id,
		 					'billing_email'=>$value->userDetail->email,
		 					'currency'=>$invoice->currency,
		 					'invoice_status'=>$invoice->status,
		 					'invoice_created_date'=>date('Y-m-d H:i:s',$invoice->created),
		 					'response'=>json_encode($invoice,true)
		 				]);

		 				InvoiceItem::where('id',$invoice_item_created->id)->update([
		 					'invoice_master_id' => $inserId->id
		 				]);

		 				$sent =  $stripe->invoices->sendInvoice($invoice->id);

		 				if($sent){
		 					$inserId = Invoice::where('invoice_id', $invoice->id)->update([
		 						'invoice_status'=> $sent->status,
		 						'response' => json_encode($sent,true),
		 						'hosted_invoice_url' => $sent->hosted_invoice_url
		 					]);

		 					Subscription::where('id',$value->id)->update([
		 						'invoice_link_expiration' => date('Y-m-d',strtotime('+ '.$days_until_due.' days',strtotime(now()))),
		 						'reminder_on' => date('Y-m-d',strtotime('+2 day',strtotime(now()))),
		 					]);
		 				}

		 			}
		 		}catch (Exception $e) {

		 		}

		 	}
		 }

		}

	}