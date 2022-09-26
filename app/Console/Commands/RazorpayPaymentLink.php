<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RazorpaySubscription;
use App\Package;
use App\Traits\RazorPayTrait;

class RazorpayPaymentLink extends Command
{
  use RazorPayTrait;
  
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Razorpay:PaymentLink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create payment links';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      // $check_date = date('Y-m-d',strtotime('+1 day'));
      $check_date = date('Y-m-d');
      $get_data = RazorpaySubscription::with('userDetail')->where('next_invoice_on',$check_date)->get();
      
      file_put_contents(dirname(__FILE__).'/logs/get_data.txt',print_r($get_data,true));

      if(isset($get_data) && !empty($get_data)){
        foreach($get_data as $value){

          $package_details = Package::where('id',$value->plan_id)->first();

          file_put_contents(dirname(__FILE__).'/logs/package_details.txt',print_r($package_details,true));
          $post_data = array(
            'amount' => $value->amount*100,
            'currency' => 'USD',
            'description' => $package_details->name .' - Subscription',
            'customer_name'=> ($value->userDetail)?$value->userDetail->name:'',
            'customer_email'=> ($value->userDetail)?$value->userDetail->email:'',
            'customer_contact'=> ($value->userDetail)?'+91'.$value->userDetail->phone:'',
            'callback_url'=> \config('app.base_url'),
            'callback_method'=> 'get',
            'expire_by'=> strtotime('+1 day',strtotime($value->reminder_on_3))
          );

          file_put_contents(dirname(__FILE__).'/logs/post_data.txt',print_r($post_data,true));
          
          $create_payment_link = $this->create_payment_link($post_data);
          file_put_contents(dirname(__FILE__).'/logs/create_payment_link.txt',print_r($create_payment_link,true));

          if($create_payment_link->status == 'created'){
            RazorpaySubscription::where('id',$value->id)->update([
              'payment_link_id'=>$create_payment_link->id,
              'payment_link' => $create_payment_link->short_url,
              'payment_status' => 'past due'
            ]);
          }       
        }
      }
    }

  }