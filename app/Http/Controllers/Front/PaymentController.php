<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Stripe;
use Auth;
use Crypt;
use Mail;
use App\User;
use App\Package;
use App\UserPackage;
use App\UserAddress;
use App\Subscription;
use App\SubscriptionItem;
use App\Country;
use App\Invoice;
use App\InvoiceItem;
use App\Coupon;
use App\UserCard;
use App\UserCredit;
use App\InvoiceChange;

class PaymentController extends Controller {

    private function send_cancelled_email($user){
        $data = array('name' => $user->name);
        \Mail::send(['html' => 'mails/front/subscription_downgrade'], $data, function($message) use($user) {
            $message->to($user->email, $user->company)
            ->subject('Subscription Refund!');
            $message->from(\config('app.mail'), 'Agency Dashboard');
        });
        if (\Mail::failures()) {
            return false;
        } else {
            return true;
        }
    }

    public function thankyou() {
        $user = Auth::user();
        if($user <> null){
            $get_user_package = UserPackage::with('package')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
            $redirect_link = 'https://' . $user->company_name . '.' . \config('app.APP_DOMAIN') . 'dashboard/' . Crypt::encrypt($user->id);
            Session::flush();
            return view('/thankyou', ['redirect_link' => $redirect_link, 'package_name' => $get_user_package->package->name]);
        }else{
            return view('/thankyou', ['redirect_link' => '', 'package_name' => 'Freelancer']);
        }
    }

    public function stripePost(Request $request) {
        $input = $request->all();
        
        $referrer_url = 'direct';
        if($input['referer'] !== '' && $input['referer'] <> null){
            $referrerUrl = parse_url($input['referer']);
            $referrer_url = $referrerUrl['host'];
        }

        $decode_data = base64_decode($input['data-key']);
        $explode = explode('+',$decode_data);

        $coupon_code = $coupon = '';
        $coupon_id = 0; $discounted_amount =  0;

        $email = $explode[0];
        $password = $explode[1];
        $company = $explode[2];
        $vanity_url = $explode[3];
        $package_id = $explode[4];
        $package_state = $explode[5];
        $coupon_code = $explode[6];

        $result =  Package::where('id',$package_id)->orderBy('created_at', 'desc')->first();

        if($package_state == 'month'){
            $package_amount = $result->monthly_amount;
        }else{
            $package_amount = $result->yearly_amount*12;
        }

        if(!empty($coupon_code) && $coupon_code <> null){
            $coupon_data = Coupon::where('code',$coupon_code)->first();
            $after_discount = $this->calculate_discount($package_amount,$coupon_data);
            // echo "<pre>";
            // print_r($discount_calculation);
            // die
            // $package_amount = $discount_calculation['after_discount'];
        }


        $exists = User::where('email',$email)->orwhere('company',$company)->orwhere('company_name',$vanity_url)->first();
        if(!empty($exists)){
            return back()->with('error', '(Email, Company Name, Vanity url) One of the fields have been already taken.');
        }else{
            $country = Country::where('id', $input['country'])->first();
            if($input['country'] !== '99'){
                $string = $input['plan'];
                $field = ['stripe_price_id','stripe_price_yearly_id'];
                $trial_days = Package::
                where(function ($query) use($string, $field) {
                    for ($i = 0; $i < count($field); $i++){
                        $query->orwhere($field[$i], 'LIKE',  '%' . $string .'%');
                    }      
                })
                ->first();

                if($input['plan'] == $trial_days->stripe_price_id){
                    $amount  = $trial_days->monthly_amount;
                } else  if($input['plan'] == $trial_days->stripe_price_yearly_id){
                    $amount  = $trial_days->yearly_amount*12;
                }

                $token = $request->stripeToken;

                try {
                    $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
                    $customer = $stripe->customers->create([
                        'email' => $email,
                        'name' => $input['billing_name'],
                        'shipping' => [
                            'address' => [
                                'line1' => $input['address_line_1'],
                                'line2' => $input['address_line_2'],
                                'city' => $input['city'],
                                'country' => $country->countries_name,
                                'postal_code' => $input['postal_code'],
                            ],
                            'name' => $input['billing_name'],
                        ],
                        'address' => [
                            'line1' => $input['address_line_1'],
                            'line2' => $input['address_line_2'],
                            'city' => $input['city'],
                            'country' => $country->countries_name,
                            'postal_code' => $input['postal_code'],
                        ],
                    ]);

                    if (!empty($customer)) {
                        $paymentMethod = $stripe->paymentMethods->create([
                            'type' => 'card',
                            'card' => ['token' => $token]
                        ]);

                        $customer_payment_method = $stripe->paymentMethods->attach(
                            $paymentMethod->id, ['customer' => $customer->id]
                        );

                        $customer = $stripe->customers->update($customer->id,[
                            'invoice_settings' => [
                                'default_payment_method' => $paymentMethod->id,
                            ],
                        ]);

                        $paymentIntents =   $stripe->paymentIntents->create([
                            'amount' => (int)$amount*100,
                            'currency' => 'usd',
                            'payment_method_types' => ['card'],
                            'customer'=>$customer->id
                        ]);


                        $subscription = $stripe->subscriptions->create([
                            'customer' => $customer->id,
                            'items' => [
                                ['price' => $input['plan']],
                            ],
                            'default_payment_method' => $customer_payment_method->id,
                            'trial_period_days' => $trial_days->duration ?: 0,
                            'coupon'=>$coupon
                        ]);



                        $charge = $stripe->charges->all(['limit' => 1,'customer'=>$customer->id]);

                        if(isset($charge) && !empty($charge->data)){
                            $charge_id = $charge->data[0]->id;
                            $payment_intent = $charge->data[0]->payment_intent;
                        }else{
                            $charge_id = $payment_intent = '';
                        }


                        $user = User::create([
                            'name' => ucwords($input['billing_name']),
                            'email'=>$email,
                            'password'=>Hash::make($password),
                            'role'=>'front',
                            'role_id'=>'2',
                            'company_name'=>strtolower(str_replace(' ','',$vanity_url)),
                            'company'=>trim($company),
                            'stripe_id' => $customer->id,
                            'card_brand'=>$customer_payment_method->card->brand,
                            'card_last_four'=>$customer_payment_method->card->last4,
                            'purchase_mode'=>1,
                            'referer' => $referrer_url
                        ]);
                        if ($user) {
                            $email_token = base64_encode($user->created_at.$user->id);
                            User::where('id',$user->id)->update(['email_verification_token'=>$email_token,'email_sent_at'=>now()]);

                            $package = Package::where('id', $package_id)->first();
                            if($package_state == 'month'){
                                $price = $package->monthly_amount;
                            }elseif($package_state == 'year'){
                                $price = $package->yearly_amount*12;
                            }

                            UserPackage::create([
                                'user_id' => $user->id,
                                'package_id' => $package_id,
                                'projects' => $package->number_of_projects,
                                'keywords' => $package->number_of_keywords,
                                'flag' => '1',
                                'trial_days' => $package->duration ?: 0,
                                'price'=>$price,
                                'subscription_type'=>$package_state,
                                'package_purchase' => 1
                            ]);


                            UserAddress::create([
                                'user_id' => $user->id,
                                'address_line_1' => $input['address_line_1'],
                                'address_line_2' => $input['address_line_2'],
                                'city' => $input['city'],
                                'country' => $input['country'],
                                'zip' => $input['postal_code']
                            ]);

                            UserCredit::create([
                               'user_id' => $user->id,
                               'package_credit' => $package->site_audit_page
                           ]);

                            $save_subscription = Subscription::create([
                                'user_id' => $user->id,
                                'charge_id'=>$charge_id,
                                'payment_intent_id'=>$payment_intent,
                                'payment_id'=>$customer_payment_method->id,
                                'customer_id'=>$customer->id,
                                'stripe_id' => $subscription->id,
                                'coupon_id'=>$coupon_id
                            ]);

                            Auth::loginUsingId($user->id);
                            $this->registeration($user->id);
                            $this->email_verification($user->id);
                            return redirect('/thankyou');
                        }

                    }
                }catch (Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            }else{
                $package = Package::where('id',$package_id)->first();

                if($package_state == 'month'){
                    $price = $amount = $package->inr_monthly_amount;
                    $stripe_plan = $package->inr_price_monthly_id;
                    $interval = '1 month';
                }elseif($package_state == 'year'){
                    $amount = $package->inr_yearly_amount;
                    $price =  $package->inr_yearly_amount*12;
                    $stripe_plan = $package->inr_price_yearly_id;
                    $interval = '1 year';
                }

                $start_date = strtotime(now());
                $end_date = strtotime('+14 day',$start_date);

                $invoicing_date = strtotime('-1 day',$end_date);
                
                $token = $request->stripeToken;
                
                try {
                    $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
                    $customer = $stripe->customers->create([
                        'email' => $email,
                        'name' => $input['billing_name'],
                        'shipping' => [
                            'address' => [
                                'line1' => $input['address_line_1'],
                                'line2' => $input['address_line_2'],
                                'city' => $input['city'],
                                'country' => $country->countries_name,
                                'postal_code' => $input['postal_code'],
                            ],
                            'name' => $input['billing_name'],
                        ],
                        'address' => [
                            'line1' => $input['address_line_1'],
                            'line2' => $input['address_line_2'],
                            'city' => $input['city'],
                            'country' => $country->countries_name,
                            'postal_code' => $input['postal_code'],
                        ],
                    ]);
                    if (!empty($customer)) {
                        $user = User::create([
                            'name' => ucwords($input['billing_name']),
                            'email'=>$email,
                            'password'=>Hash::make($password),
                            'role'=>'front',
                            'role_id'=>'2',
                            'company_name'=>strtolower(str_replace(' ','',$vanity_url)),
                            'company'=>trim($company),
                            'stripe_id' => $customer->id,
                            'purchase_mode'=>2,
                            'referer' => $referrer_url
                        ]);
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
                                'price'=>$price,
                                'subscription_type'=>$package_state,
                                'package_purchase' => 1
                            ]);

                            UserAddress::create([
                                'user_id' => $user->id,
                                'address_line_1' => $input['address_line_1'],
                                'address_line_2' => $input['address_line_2'],
                                'city' => $input['city'],
                                'country' => $input['country'],
                                'zip' => $input['postal_code']
                            ]);

                            UserCredit::create([
                                'user_id' => $user->id,
                                'package_credit' => $package->site_audit_page
                            ]);

                            $subscription = Subscription::create([
                                'user_id' => $user->id,
                                'coupon_id'=>$coupon_id,
                                'customer_id'=>$customer->id,
                                'subscription_interval' => $interval,
                                'current_period_start' => date('Y-m-d H:i:s',$start_date),
                                'current_period_end' => date('Y-m-d H:i:s', $end_date),
                                'stripe_plan' => $stripe_plan,
                                'discount'=>$discounted_amount,
                                'coupon_name'=>$coupon_code,
                                'amount'=>$price,
                                'trial_ends_at'=>date('Y-m-d H:i:s',$end_date),
                                'stripe_status'=>'trialing',
                                'next_invoice_on'=> date('Y-m-d',$invoicing_date)                                
                            ]);

                            // $invoice = Invoice::create([
                            //     'subscription_master_id'=> $subscription->id,
                            //     'invoice_number' => 'AD-'.strtoupper(substr($company, 0, 3)).'-0001',
                            //     'customer_id' => $customer->id,
                            //     'billing_email'=> $email,
                            //     'currency' => 'inr',
                            //     'invoice_status'=> 'paid',
                            //     'invoice_created_date'=> date('Y-m-d H:i:s'),
                            //     'current_period_start' => date('Y-m-d H:i:s',$start_date),
                            //     'current_period_end' => date('Y-m-d H:i:s', $end_date),
                            //     'amount_paid'=>0.00,
                            //     'invoice_type'=>'trialing',
                            //     'invoice_interval'=>$interval
                            // ]);

                            // InvoiceItem::create([
                            //     'invoice_master_id'=>$invoice->id,
                            //     'description'=>'Trial Period for '.$package->name,
                            //     'amount'=> 0.00,
                            //     'currency'=>'inr',
                            //     'quantity'=>1
                            // ]);

                            Auth::loginUsingId($user->id);
                            $this->registeration($user->id);
                            $this->email_verification($user->id);
                            $this->trial_invoice($user->id,$subscription->id,$package_id,$stripe_plan);
                            return redirect('/thankyou');
                        }
                    }
                }catch (Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            }
        } 

    }

    public function stripe_new (Request $request){ 
        $user = array(); $password = '';
        $countries = Country::where('status',1)->get();
        if($request->has('reg_id')){
            $encoded = $request->reg_id;
            $string = base64_decode($encoded);
            $exploded = explode('+',$string);
            $email = $exploded[0];
            $package_id = $exploded[4];
            $package_state = $exploded[5];
            $coupon_code = $exploded[6];
        }

        if($request->has('id')){
            $encoded = $request->id;
            $string = base64_decode($encoded);
            $exploded_data = explode('+',$string);
            $email = $exploded_data[0];
            $package_id = $exploded_data[3];
            $package_state = $exploded_data[4];
            $user_id = $exploded_data[5];
            $user = User::with('UserAddress')->where('id',$user_id)->first();
        }



        $result =  Package::where('id',$package_id)->orderBy('created_at', 'desc')->first();

        if($package_state == 'month'){
            $package_price_id = $result->stripe_price_id;
            $package_amount = $result->monthly_amount;
            // $package_inr_price_id = $result->inr_price_monthly_id;
            // $package_inr_amount = $result->inr_monthly_amount;
        }elseif($package_state == 'free'){
            $countries = Country::get();
            $package_price_id = $package_inr_price_id = '';
            $package_amount = $package_inr_amount =  0;
        }else{
            $package_price_id = $result->stripe_price_yearly_id;
            $package_amount = $result->yearly_amount*12;
            // $package_inr_price_id = $result->inr_price_yearly_id;
            // $package_inr_amount = $result->inr_yearly_amount;
        }

      //  dd($package_price_id);

        $package_name = $result->name;

        if(isset($exploded[6]) && !empty($exploded[6]) && ($exploded[6] <> null)){
            $coupon_code = $exploded[6];
            $coupon_data = Coupon::where('code',$exploded[6])->first();
            $after_discount = $this->calculate_discount($package_amount,$coupon_data);
            $coupon_state = 1;
        }else{
            $coupon_state = $after_discount =  0; $coupon_code = '';
        } 

        //  $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
        // $prices = $stripe->prices->all(['active' => true]);
        // echo "<pre>";
        // print_r($prices);
        // die;
        // if (!empty($prices)) {
        //     foreach ($prices as $key => $price) {
        //         $prices->data[$key]['product_data'] = $stripe->products->retrieve(
        //             $price->product
        //         );
        //     }
        // }

        $prices = Package::where('status',1)->get();

        // echo "<pre>";
        // print_r(Session::get('referrer'));

        return view('front.stripe_subscription', [
            'prices' => $prices,
            'package_price_id' => $package_price_id,
            'countries' => $countries,
            'email' => $email,
            'string'=>$encoded,
            'after_discount'=>$after_discount,
            'package_amount'=>$package_amount,
            'coupon_state'=>$coupon_state,
            'package_state'=>$package_state,
            'user'=>$user,
            'coupon_code'=>$coupon_code,
            'packageId'=>$package_id,
            'package_name' => $package_name,
           // 'registeration_data' => $encoded,
            'subscription_type'=>($request->has('reg_id'))?'registeration':'existing',
            'purchase_mode'=>($request->has('id'))?$user->purchase_mode:'',
            'referer'=> Session::get('referrer')

            // 'package_inr_price_id'=>$package_inr_price_id,
            // 'package_inr_amount'=>$package_inr_amount
        ]);
    }


    public function stripe_new_bkp (Request $request){ 
        $user = array(); $password = '';
        $countries = Country::get();
        if($request->has('reg_id')){
            $encoded = $request->reg_id;
            $string = base64_decode($encoded);
            $exploded = explode('+',$string);
            $email = $exploded[0];
            $package_id = $exploded[4];
            $package_state = $exploded[5];
            $coupon_code = $exploded[6];
        }

        if($request->has('id')){
            $encoded = $request->id;
            $string = base64_decode($encoded);
            $exploded_data = explode('+',$string);
            $email = $exploded_data[0];
            $package_id = $exploded_data[3];
            $package_state = $exploded_data[4];
            $user_id = $exploded_data[5];
            $user = User::with('UserAddress')->where('id',$user_id)->first();
        }
        $result =  Package::where('id',$package_id)->orderBy('created_at', 'desc')->first();

        if($package_state == 'month'){
            $package_price_id = $result->stripe_price_id;
            $package_amount = $result->monthly_amount;
        }elseif($package_state == 'free'){
            $package_price_id = '';
            $package_amount = 0;
        }else{
            $package_price_id = $result->stripe_price_yearly_id;
            $package_amount = $result->yearly_amount*12;
        }

        $package_name = $result->name;

        if(isset($exploded[6]) && !empty($exploded[6]) && ($exploded[6] <> null)){
            $coupon_code = $exploded[6];
            $coupon_data = Coupon::where('code',$exploded[6])->first();
            $after_discount = $this->calculate_discount($package_amount,$coupon_data);
            $coupon_state = 1;
        }else{
            $coupon_state = $after_discount =  0; $coupon_code = '';
        } 

        $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
        $prices = $stripe->prices->all(['active' => true]);
        if (!empty($prices)) {
            foreach ($prices as $key => $price) {
                $prices->data[$key]['product_data'] = $stripe->products->retrieve(
                    $price->product
                );
            }
        }

        return view('front.stripe_subscription', [
            'prices' => $prices,
            'package_price_id' => $package_price_id,
            'countries' => $countries,
            'email' => $email,
            'string'=>$encoded,
            'after_discount'=>$after_discount,
            'package_amount'=>$package_amount,
            'coupon_state'=>$coupon_state,
            'package_state'=>$package_state,
            'user'=>$user,
            'coupon_code'=>$coupon_code,
            'packageId'=>$package_id,
            'package_name' => $package_name,
           // 'registeration_data' => $encoded,
            'subscription_type'=>($request->has('reg_id'))?'registeration':'existing',
            'purchase_mode'=>($request->has('id'))?$user->purchase_mode:''

        ]);

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
        return $final;
    }

    private function registeration($user_id) {
        $app_domain = \config('app.APP_DOMAIN');
        $user = User::where('id', $user_id)->select('name', 'email', 'company_name','company')->first();
        $link = 'https://' . $user->company_name . '.' . $app_domain . 'login';
        $data = array('name' => $user->company, 'email' => $user->email, 'from' => \config('app.MAIL_FROM_NAME'), 'link' => $link);
        \Mail::send(['html' => 'mails/front/registeration'], $data, function($message) use($user) {
            $message->to($user->email, $user->company)
            ->subject('Welcome to Agency Dashboard!');
            $message->from(\config('app.mail'), 'Agency Dashboard');
        });
        if (\Mail::failures()) {
            return false;
        } else {
            return true;
        }
    }

    private function email_verification($user_id){
        $app_domain = \config('app.APP_DOMAIN');
        $user = User::where('id', $user_id)->first();
        $link = 'https://' . $user->company_name . '.' . $app_domain . 'confirmation/'.$user->email_verification_token;
        $data = array('name' => $user->name, 'email' => $user->email, 'from' => \config('app.MAIL_FROM_NAME'), 'link' => $link);
        \Mail::send(['html' => 'mails/front/email_verification'], $data, function($message) use($user) {
            $message->to($user->email, $user->name)->subject
            ('Activate Account - Agency Dashboard');
            $message->from(\config('app.mail'), 'Agency Dashboard');
        });
        if (\Mail::failures()) {
            return false;
        } else {
            return true;
        }
    }


    public function ajax_calculate_discounts(Request $request){
        $final_array = array();
        if(!empty($request->code)){
            $string = $request->amount;
            $field = ['stripe_price_id','stripe_price_yearly_id'];
            $package_info = Package::
            where(function ($query) use($string, $field) {
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'LIKE',  '%' . $string .'%');
                }      
            })
            ->first();

            if($string == $package_info->stripe_price_id){
                $amount  = $package_info->monthly_amount;
            } else  if($string == $package_info->stripe_price_yearly_id){
                $amount  = $package_info->yearly_amount*12;
            }

            $coupon_data = Coupon::where('code',$request->code)->first();

            if($coupon_data <> null){
                $after_discount = $this->calculate_discount($amount,$coupon_data);
                $final_array = array('after_discount'=>$after_discount,'amount'=>$amount,'status'=>'success');
            }else{
                $final_array = array('status'=>'error');
            }
        }else{
            $final_array = array('status'=>'error');
        }
        return $final_array;
    }

    public function ajax_renew_stripe_subsciption(Request $request){
        $card_token = $request->stripeToken;
        $user_id = $request->user_id;
        $package_id = $request->package_id;
        $package_type = $request->package_type;
        $prev_subscription_id = $request->previous_subscription_id;
        $plan_type = $request->plan_type;

        $user = User::with('UserAddress')->where('id',$user_id)->first();

        $customer_id = $user->stripe_id; /*stripe customer id*/

        $country = Country::where('id', $user->UserAddress->country)->first();

        $package_info = Package::where('id',$package_id)->first();

        if($country->id !== 99){ // stripe automatic
            if($package_type == 'month'){
                $amount  = $package_info->monthly_amount;
                $plan_id = $package_info->stripe_price_id;
            }elseif($package_type == 'year'){
                $amount  = $package_info->yearly_amount*12;
                $plan_id = $package_info->stripe_price_yearly_id;
            }
            
            $subscription = Subscription::where('user_id',$user_id)->where('customer_id',$customer_id)->latest()->first();

            try {
                $charge_id = $payment_intent = '';
                $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));

                if($subscription <> null){
                    $subscription_id = $subscription->stripe_id;
                    if(($user->subscription_status == 1) && ($subscription->stripe_status == 'active' || $subscription->stripe_status == 'trialing')){

                        $response = $stripe->subscriptions->cancel(
                          $subscription_id,
                          [
                            'invoice_now'=>true,
                            'prorate'=>true
                        ]
                    );

                        Subscription::where('stripe_id',$subscription_id)->where('user_id',$user_id)->update([
                            'canceled_at'=>date('Y-m-d H:i:s',$response->canceled_at),
                            'ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
                            'stripe_status'=>$response->status,
                            'cancel_response'=>json_encode($response,true)
                        ]);

                        User::where('id',$user->id)->update([
                            'subscription_ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
                            'subscription_status'=>1
                        ]);

                       // $this->send_cancelled_email($user);
                    }
                } // if no subscription end

                if($customer_id == null){
                    $customer = $stripe->customers->create([
                        'email' => $user->email,
                        'name' => $user->name,
                        'shipping' => [
                            'address' => [
                                'line1' => $user->UserAddress->address_line_1,
                                'line2' => $user->UserAddress->address_line_2,
                                'city' => $user->UserAddress->city,
                                'country' => $country->countries_name,
                                'postal_code' => $user->UserAddress->postal_code,
                            ],
                            'name' => $user->name,
                        ],
                        'address' => [
                            'line1' => $user->UserAddress->address_line_1,
                            'line2' => $user->UserAddress->address_line_2,
                            'city' => $user->UserAddress->city,
                            'country' => $country->countries_name,
                            'postal_code' => $user->UserAddress->postal_code,
                        ]
                    ]);
                    $customer_id = $customer->id;
                }



                $paymentMethod = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => ['token' => $card_token]
                ]);

                $customer_payment_method = $stripe->paymentMethods->attach(
                    $paymentMethod->id, ['customer' => $customer_id]
                );

                $paymentIntents =   $stripe->paymentIntents->create([
                    'amount' => $amount*100,
                    'currency' => 'usd',
                    'payment_method_types' => ['card'],
                    'customer'=>$customer_id
                ]);


                $subscription = $stripe->subscriptions->create([
                    'customer' => $customer_id,
                    'items' => [
                        ['price' => $plan_id],
                    ],
                    'default_payment_method' => $customer_payment_method
                ]);

                $charge = $stripe->charges->all(['limit' => 1,'customer'=>$customer_id]);
                if(isset($charge) && !empty($charge->data)){
                    $charge_id = $charge->data[0]->id;
                    $payment_intent = $charge->data[0]->payment_intent;
                }

                User::where('id',$user_id)->update([
                    'card_brand'=>$customer_payment_method->card->brand,
                    'card_last_four'=>$customer_payment_method->card->last4,
                    'card_exp_month'=>$customer_payment_method->card->exp_month,
                    'card_exp_year'=>$customer_payment_method->card->exp_year,
                    'subscription_status'=>1,
                    'stripe_id' => $customer_id,
                    'purchase_mode' => 1,
                    'user_type' =>0
                ]);

                UserPackage::create([
                    'user_id' => $user_id,
                    'package_id' => $package_id,
                    'projects' => $package_info->number_of_projects,
                    'keywords' => $package_info->number_of_keywords,
                    'flag' => '1',
                    'trial_days' => 0,
                    'price'=>$amount,
                    'subscription_type'=>$package_type,
                    'package_purchase' => 1
                ]);

                $existingCredits = UserCredit::where('user_id', $user_id)->latest()->first();
                if(!empty($existingCredits)){
                    UserCredit::create([
                        'user_id'=>$user_id,
                        'used_credit'=>$existingCredits->used_credit,
                        'additional_credit'=>$existingCredits->additional_credit
                    ]);
                }

                Subscription::create([
                    'user_id' => $user_id,
                    'charge_id'=>$charge_id,
                    'payment_intent_id'=>$payment_intent,
                    'payment_id'=>$customer_payment_method->id,
                    'customer_id'=>$customer_id,
                    'stripe_id' => $subscription->id,
                    'coupon_id'=>0
                ]);

                $response['subscription_type'] = 'recurring';
                $response['status'] = 'success';
                $response['message'] = 'Plan has been updated successfully.';
            }catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = $e->getMessage();
            }
        }else{ //stripe manual
        // $subscription =Subscription::select('customer_id','stripe_id')->where('user_id',$user_id)->latest()->first();
        // dd($subscription);
        // $stripe_id = $subscription->stripe_id;

        // /*cancel subscription if already in usd*/ 
        // if(isset($stripe_id) && $stripe_id <> null){
        //     $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
        //     $response = $stripe->subscriptions->cancel($stripe_id);

        //     Subscription::where('stripe_id',$stripe_id)->where('user_id',$user_id)->update([
        //         'canceled_at'=>date('Y-m-d H:i:s',$response->canceled_at),
        //         'ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
        //         'cancel_response'=>json_encode($response,true)
        //     ]);

        //    $delete_customer =  $stripe->customers->delete($customer_id);
        //     User::where('id',$user_id)->update([
        //         'stripe_id' => NULL,
        //         'card_brand' => NULL,
        //         'card_last_four' => NULL,
        //         'card_exp_month' => NULL,
        //         'card_exp_year' => NULL
        //     ]);
        // }
        /*cancel subscription if in usd*/ 
        $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));

        if($customer_id == null){
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
                'shipping' => [
                    'address' => [
                        'line1' => $user->UserAddress->address_line_1,
                        'line2' => $user->UserAddress->address_line_2,
                        'city' => $user->UserAddress->city,
                        'country' => $country->countries_name,
                        'postal_code' => $user->UserAddress->postal_code,
                    ],
                    'name' => $user->name,
                ],
                'address' => [
                    'line1' => $user->UserAddress->address_line_1,
                    'line2' => $user->UserAddress->address_line_2,
                    'city' => $user->UserAddress->city,
                    'country' => $country->countries_name,
                    'postal_code' => $user->UserAddress->postal_code,
                ]
            ]);
            $customer_id = $customer->id;
        }

     // $invoice_list = $stripe->invoices->all(['customer'=>$customer_id,'status'=>'open']);

    //   if(isset($invoice_list) && !empty($invoice_list) && count($invoice_list) > 0){
    //     foreach($invoice_list as $invoice){
    //         $invoice_id = $invoice->invoice_id;
    //         $stripe->invoices->voidInvoice($invoice_id);

    //         Invoice::where('id',$invoice->id)->update([
    //             'invoice_status'=> 'void',
    //             'invoice_type'=> 'canceled'
    //         ]);

    //         Subscription::where('id',$prev_subscription_id)->update([
    //             'stripe_status' => 'canceled',
    //             'next_invoice_on' => NULL,
    //             'invoice_link_expiration' => NULL,
    //             'reminder_on' => NULL,
    //             'canceled_at'=> date('Y-m-d H:i:s',strtotime(now()))
    //         ]);
    //     }
    // }

        if($request->package_type == 'month'){
            $price = $amount = $package_info->inr_monthly_amount;
            $stripe_plan = $package_info->inr_price_monthly_id;
            $usd_stripe_price = $package_info->monthly_amount;
            $inr_stripe_price = $package_info->inr_monthly_amount;
            $interval = '1 month';
        }elseif($request->package_type == 'year'){
            $amount = $package_info->inr_yearly_amount;
            $price =  $package_info->inr_yearly_amount*12;
            $stripe_plan = $package_info->inr_price_yearly_id;
            $usd_stripe_price = $package_info->yearly_amount;
            $inr_stripe_price = $package_info->inr_yearly_amount/12;
            $interval = '1 year';
        }

        $start_date = strtotime(now());
        $end_date = strtotime('+ '.$interval,$start_date);

   // $token = $request->stripeToken;

        try {
            $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));

        // $paymentMethod = $stripe->paymentMethods->create([
        //     'type' => 'card',
        //     'card' => ['token' => $token]
        // ]);

        // $customer_payment_method = $stripe->paymentMethods->attach(
        //     $paymentMethod->id, ['customer' => $customer_id]
        // );

        // $stripe->customers->update($customer_id,[
        //     'invoice_settings' => [
        //         'default_payment_method' => $paymentMethod->id,
        //     ],
        // ]);

        // User::where('id',$user_id)->update(['subscription_status'=> 1,'subscription_ends_at'=>NULL]);

        // UserPackage::create([
        //     'user_id' => $user_id,
        //     'package_id' => $package_id,
        //     'projects' => $package_info->number_of_projects,
        //     'keywords' => $package_info->number_of_keywords,
        //     'flag' => '1',
        //     'trial_days' => 0,
        //     'price'=>$price,
        //     'subscription_type'=>$package_type,
        //     'package_purchase' => 1
        // ]);

        // $existingCredits = UserCredit::where('user_id', $user_id)->latest()->first();
        // if(!empty($existingCredits)){
        //     UserCredit::create([
        //         'user_id' => $user_id,
        //         'package_credit' => $package_info->site_audit_page
        //     ]);
        // }

            $subscription = [
                'user_id' => $user_id,
                'customer_id'=>$customer_id,
                'subscription_interval' => $interval,
                'current_period_start' => date('Y-m-d H:i:s',$start_date),
                'current_period_end' => date('Y-m-d H:i:s', $end_date),
                'stripe_plan' => $stripe_plan,
                'amount'=>$price,
                'stripe_status'=>'open',
                'next_invoice_on'=> date('Y-m-d',$start_date),                      
                'package_id'=> $package_id,
                'plan_type' => $plan_type                             
            ];



        //   $subscription = Subscription::create([
        //     'user_id' => $user_id,
        //     'customer_id'=>$customer_id,
        //     'subscription_interval' => $interval,
        //     'current_period_start' => date('Y-m-d H:i:s',$start_date),
        //     'current_period_end' => date('Y-m-d H:i:s', $end_date),
        //     'stripe_plan' => $stripe_plan,
        //     'amount'=>$price,
        //     'stripe_status'=>'open',
        //     'next_invoice_on'=> date('Y-m-d',$start_date)                                
        // ]);

            $invoice_creation = self::create_plan_invoice($subscription);
            $invoice_hosted_url = $invoice_creation['hosted_invoice_url'];
            $response['subscription_type'] = 'manual';
            $response['status'] = 'success';
        // $response['message'] = 'Please complete your payment by clicking on the following link <a href="'.$invoice_hosted_url.'" target="_blank"> Pay Now</a>. Once your order is confirmed, your subscription will be automatically upgraded.';
            $response['invoice_id'] = $invoice_creation['invoice_id'];
            $response['hosted_invoice_url'] = $invoice_hosted_url;
            $response['package_name'] = $package_info->name;
            $response['package_type'] = $request->package_type;
            $response['package_usd'] = $usd_stripe_price;
            $response['package_inr'] = $inr_stripe_price;
            $response['projects'] = $package_info->number_of_projects;
            $response['keywords'] = $package_info->number_of_keywords;
        }catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }

    }
    return response()->json($response);
}

public function create_free_forever_subscription(Request $request){
   // dd($request->all());
    $decode_data = base64_decode($request->data_key);
    $explode = explode('+',$decode_data);
    if($request->existing_user !='' && !empty($request->existing_user)){
        $email = $explode[0];
        $company = $explode[1];
        $vanity_url = $explode[2];
        $package_id = $explode[3];
        $package_state = $explode[4];
        $user_id = $explode[5];

        $user = User::where('id',$user_id)->update([
            'name' => ucwords($request->billing_name),
            'email'=>$email,
            'stripe_id' => NULL,
            'purchase_mode'=>0,
            'user_type'=>1,
            'subscription_status'=>1,
            'subscription_ends_at'=> date('Y-m-d H:i:s',strtotime('+20 years'))
        ]);
        
        $package = Package::where('id', $package_id)->first();
        $price = 0;

        UserPackage::create([
            'user_id' => $user_id,
            'package_id' => $package_id,
            'projects' => $package->number_of_projects,
            'keywords' => $package->number_of_keywords,
            'flag' => '1',
            'trial_days' => 0,
            'price'=>$price,
            'subscription_type'=>$package_state,
            'package_purchase' => 1
        ]);


        UserAddress::where('user_id',$user_id)->update([
            'user_id' => $user_id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'country' => $request->country,
            'zip' => $request->postal_code
        ]);

        UserCredit::create([
         'user_id' => $user_id,
         'package_credit' => $package->site_audit_page
     ]);

        $dataReturn['status'] = 1;
        $dataReturn['url'] = '/thankyou';
        
    }else{

        $email = $explode[0];
        $password = $explode[1];
        $company = $explode[2];
        $vanity_url = $explode[3];
        $package_id = $explode[4];
        $package_state = $explode[5];

        $referrer_url = 'direct';
        if($request->referer !== '' && $request->referer <> null){
            $referrerUrl = parse_url($request->referer);
            $referrer_url = $referrerUrl['host'];
        }

        $country = Country::where('id', $request->country)->first();
        $user = User::create([
            'name' => ucwords($request->billing_name),
            'email'=>$email,
            'password'=>Hash::make($password),
            'role'=>'front',
            'role_id'=>'2',
            'company_name'=>strtolower(str_replace(' ','',$vanity_url)),
            'company'=>trim($company),
            'stripe_id' => NULL,
            'purchase_mode'=>0,
            'user_type'=>1,
            'subscription_ends_at'=> date('Y-m-d H:i:s',strtotime('+20 years')),
            'referer' => $referrer_url
        ]);

        $email_token = base64_encode($user->created_at.$user->id);
        User::where('id',$user->id)->update(['email_verification_token'=>$email_token,'email_sent_at'=>now()]);

        $package = Package::where('id', $package_id)->first();
        $price = 0;

        if($package <> null){
            UserPackage::create([
                'user_id' => $user->id,
                'package_id' => $package_id,
                'projects' => $package->number_of_projects,
                'keywords' => $package->number_of_keywords,
                'flag' => '1',
                'trial_days' => 0,
                'price'=>$price,
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

            Auth::loginUsingId($user->id);
            $this->registeration($user->id);
            $this->email_verification($user->id);
            // $this->admin_free_forever($user->id);

            $dataReturn['status'] = 1;
            $dataReturn['url'] = '/thankyou';
        }
        else{
         $dataReturn['status'] = 0;
     }
 }
 return response()->json($dataReturn);
}


public function trial_invoice($user_id,$subscription_id,$plan_id,$stripe_plan) {
    $subscription_data = Subscription::where('id',$subscription_id)->where('stripe_plan',$stripe_plan)->first();

    $user_detail = User::with('UserAddress')->where('id',$user_id)->first();
    $agency_name = $user_detail->company_name;

    $package_detail = Package::where('id',$plan_id)->first();

   // $invoice = Invoice::where('subscription_master_id',$subscription_id)->first();

    $package_name = $package_detail->name;

    $discounted_value = $amount_paid = 0.00;

    $country = Country::where('id',$user_detail->UserAddress->country)->first();

    $amount_to_be_charged = Subscription::display_amount($subscription_id);

    $data = array(
        'email' => $user_detail->email,
        'account_name' => $user_detail->name,
        'amount_paid' => $amount_paid,
        'start' => date("Y-m-d", strtotime($subscription_data->current_period_start)),
        'end' => date("Y-m-d", strtotime($subscription_data->current_period_end)),
        'city' => $user_detail->UserAddress->city,
        'country' => $country->countries_name,
        'line1' => $user_detail->UserAddress->address_line_1,
        'line2' => $user_detail->UserAddress->address_line_2,
        'postal_code' => $user_detail->UserAddress->zip,
        'discounted_value' => $discounted_value,
        'from' => \config('app.MAIL_FROM_NAME'),
        'package_name'=>$package_name,
        'package_price'=>$amount_to_be_charged,
        'agency_name'=>$agency_name,
        'interval'=>$subscription_data->subscription_interval
    );

    \Mail::send(['html' => 'mails/front/subscription_invoice_trial'], $data, function($message) use($data) {
        $message->to($data['email'], $data['account_name'])->subject('Invoice (14 Day Free Trial) - Agency Dashboard');
        $message->from(\config('app.mail'), 'Agency Dashboard');
    });

    $admin = User::where('role_id', 1)->first();
  \Mail::send(['html' => 'mails/front/admin_subscription_invoice_trial'], $data, function($admin_message) use($admin,$data) {
    $admin_message->to($admin->email, $admin->name)->subject('New trial - '.$data['agency_name'].' - Agency Dashboard');
    $admin_message->from(\config('app.mail'), 'Agency Dashboard');
  });
}


private function create_plan_invoice($subscription){
    $user = User::where('id',$subscription['user_id'])->first();
    $start_date = strtotime($subscription['current_period_start']);
    $end_date = strtotime($subscription['current_period_end']);

    try{
        $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
        $invoice_items =  $stripe->invoiceItems->create(
            [
                'customer' => $subscription['customer_id'],
                'price' => $subscription['stripe_plan'],
                'period'=> [
                    'end' => $end_date,
                    'start' => $start_date
                ]
            ]
        );

        if($invoice_items){    
            $invoice = $stripe->invoices->create(
                [
                    'auto_advance' => false,
                    'collection_method' => 'send_invoice',
                    'customer' => $subscription['customer_id'],
                    'due_date' => strtotime('+10 minute'),
                    // 'custom_fields'=> [
                    //     ['name'=>'user_id','value'=>$subscription['user_id']],
                    //     ['name'=>'subscription_type','value'=> 'change_plan'],
                    //     ['name'=>'package_id','value'=>$subscription['package_id']],
                    //     ['name'=>'interval','value'=>$subscription['subscription_interval']]
                    // ],  
                    'metadata' => [
                        "user_id" => $subscription['user_id'],
                        "subscription_type" => 'change_plan',
                        "package_id" => $subscription['package_id'],
                        "interval" => $subscription['subscription_interval']
                    ]                                                  
                ]
            );

            InvoiceChange::create([
                'user_id' => $subscription['user_id'],
                'invoice_id' => $invoice->id
            ]);

            $sent =  $stripe->invoices->sendInvoice($invoice->id);

            $response['invoice_id'] = $invoice->id;
            $response['hosted_invoice_url'] = $sent->hosted_invoice_url;

            return $response;           
        }
    }catch (Exception $e) {

    }
}

private function create_plan_invoice_bkp($subscription){
  //  $days_until_due = 9; //default 9 days
    $user = User::where('id',$subscription->user_id)->first();
    // $invoice_count = Invoice::where('customer_id',$subscription->customer_id)->get();

    // $string = 'AD-'.strtoupper(substr($user->company_name, 0, 3));

    // if(count($invoice_count) > 0){
    //     $invoice_number = Invoice::generate_invoice_number(count($invoice_count),$string);
    // }else{
    //     $invoice_number = Invoice::generate_invoice_number(0,$string);
    // }

    $start_date = strtotime($subscription->current_period_start);
    $end_date = strtotime($subscription->current_period_end);

    try{
        $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
        $invoice_items =  $stripe->invoiceItems->create(
            [
                'customer' => $subscription->customer_id,
                'price' => $subscription->stripe_plan,
                'period'=> [
                    'end' => $end_date,
                    'start' => $start_date
                ]
            ]
        );

        if($invoice_items){
           // $invoice_item_id = $invoice_items->id;

            // $invoice_item_created = InvoiceItem::create([
            //     'description'=>$invoice_items->description,
            //     'amount'=>$invoice_items->amount/100,
            //     'currency'=>$invoice_items->currency,
            //     'quantity'=>1
            // ]);

            $invoice = $stripe->invoices->create(
                [
                    'auto_advance' => false,
                    'collection_method' => 'send_invoice',
                    'customer' => $subscription->customer_id,
                    'custom_fields'=>[
                        'user_id' => $subscription->user_id,
                        'subscription_type'=>'change plan',
                        'purchase_mode' => 2
                    ]
                    // ,
                    // 'days_until_due' => $days_until_due                                                         
                ]
            );

            // $inserId = Invoice::create([
            //     'subscription_master_id' => $subscription->id,
            //     'invoice_id' => $invoice->id,
            //     'subscription_id' => NULL,
            //     'invoice_number' => $invoice_number,
            //     'customer_id'=>$subscription->customer_id,
            //     'billing_email'=>$user->email,
            //     'currency'=>$invoice->currency,
            //     'invoice_status'=>$invoice->status,
            //     'amount_paid'=>$invoice->amount_paid,
            //     'amount_due'=>($invoice->amount_due)/100,
            //     'amount_remaining'=>($invoice->amount_remaining)/100,
            //     'invoice_created_date'=>date('Y-m-d H:i:s',$invoice->created),
            //     'response'=>json_encode($invoice,true)
            // ]);

            // InvoiceItem::where('id',$invoice_item_created->id)->update([
            //     'invoice_master_id' => $inserId->id
            // ]);

            InvoiceChange::create([
                'user_id' => $subscription->user_id,
                'invoice_id' => $invoice->id
            ]);

            $sent =  $stripe->invoices->sendInvoice($invoice->id);

            $response['invoice_id'] = $invoice->id;
            $response['hosted_invoice_url'] = $invoice->hosted_invoice_url;

            return $response;

            // if($sent){


                // Invoice::where('invoice_id', $invoice->id)->update([
                //     'invoice_status'=> $sent->status,
                //     'response' => json_encode($sent,true),
                //     'hosted_invoice_url' => $sent->hosted_invoice_url,
                //     'invoice_pdf' => $sent->invoice_pdf,
                //     'current_period_start'=>date('Y-m-d H:i:s',$sent->lines['data'][0]['period']['start']),
                //     'current_period_end'=>date('Y-m-d H:i:s',$sent->lines['data'][0]['period']['end'])
                // ]);

                // Subscription::where('id',$subscription->id)->update([
                //     'invoice_link_expiration' => date('Y-m-d',strtotime('+ '.$days_until_due.' day',strtotime(now()))),
                //     'reminder_on' => date('Y-m-d',strtotime('+2 day',strtotime(now()))),
                // ]);
            // }
        }
    }catch (Exception $e) {

    }
}

public function admin_free_forever($user_id) {
    $user_detail = User::with('UserAddress')->where('id',$user_id)->first();

    $agency_name = $user_detail->company_name;

    $country = Country::where('id',$user_detail->UserAddress->country)->first();

    $data = array(
        'email' => $user_detail->email,
        'account_name' => $user_detail->name,
        'city' => $user_detail->UserAddress->city,
        'country' => $country->countries_name,
        'line1' => $user_detail->UserAddress->address_line_1,
        'line2' => $user_detail->UserAddress->address_line_2,
        'postal_code' => $user_detail->UserAddress->zip,
        'from' => \config('app.MAIL_FROM_NAME'),
        'agency_name'=>$agency_name
    );

    $admin = User::where('role_id', 1)->first();
    \Mail::send(['html' => 'mails/front/admin_subscription_free_forever'], $data, function($admin_message) use($admin,$data) {
        $admin_message->to($admin->email, $admin->name)->subject('New signup (Free Forever) - '.$data['agency_name'].' - Agency Dashboard');
        $admin_message->from(\config('app.mail'), 'Agency Dashboard');
    });
}


}