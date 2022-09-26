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

class PaymentController extends Controller {


    public function stripePost(Request $request) {
        $input = $request->all();
        $decode_data = base64_decode($input['data-key']);
        if($input['existing_user'] !='' && !empty($input['existing_user'])){
            $explode = explode('+',$decode_data);

            $email = $explode[0];
            $company = $explode[1];
            $vanity_url = $explode[2];
            $package_id = $explode[3];
            $package_state = $explode[4];
            $user_id = $explode[5];

            $user_detail = User::where('id',$user_id)->first();
            $customer_id = $user_detail->stripe_id;
            $subscription = Subscription::where('user_id',$user_id)->where('customer_id',$customer_id)->latest()->first();
            $subscription_id = $subscription->stripe_id;

            $country = Country::where('id', $input['country'])->first();

            $string = $input['plan'];
            $field = ['stripe_price_id','stripe_price_yearly_id'];
            $package_info = Package::
            where(function ($query) use($string, $field) {
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'LIKE',  '%' . $string .'%');
                }      
            })
            ->first();

            if($input['plan'] == $package_info->stripe_price_id){
                $amount  = $package_info->monthly_amount;
            } else  if($input['plan'] == $package_info->stripe_price_yearly_id){
                $amount  = $package_info->yearly_amount*12;
            }

            $token = $request->stripeToken;

            try {
                $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
//canceling previous subscription
                if(($user_detail->subscription_status == 1) && ($subscription->stripe_status == 'active' || $subscription->stripe_status == 'trialing')){

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

                    User::where('id',$user_detail->id)->update([
                        'subscription_ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
                        'subscription_status'=>1
                    ]);

                    $this->send_cancelled_email($user_detail);
                }

//update with new subscription

                if (!empty($customer_id)) {
                    $paymentMethod = $stripe->paymentMethods->create([
                        'type' => 'card',
                        'card' => ['token' => $token]
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
                            ['price' => $input['plan']],
                        ],
                        'default_payment_method' => $customer_payment_method
                    ]);



                    $charge = $stripe->charges->all(['limit' => 1,'customer'=>$customer_id]);

                    if(isset($charge) && !empty($charge->data)){
                        $charge_id = $charge->data[0]->id;
                        $payment_intent = $charge->data[0]->payment_intent;
                    }else{
                        $charge_id = $payment_intent = '';
                    }


                    $user = User::where('id',$user_id)->update([
                        'name' => ucwords($input['billing_name']),
                        'card_brand'=>$customer_payment_method->card->brand,
                        'card_last_four'=>$customer_payment_method->card->last4,
                        'subscription_status'=>1
                    ]);
                    if ($user) {
                        $package = Package::where('id', $package_id)->first();
                        if($package_state == 'month'){
                            $price = $package->monthly_amount;
                        }elseif($package_state == 'year'){
                            $price = $package->yearly_amount*12;
                        }

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
                            'address_line_1' => $input['address_line_1'],
                            'address_line_2' => $input['address_line_2'],
                            'city' => $input['city'],
                            'country' => $input['country'],
                            'zip' => $input['postal_code']
                        ]);



                        $save_subscription = Subscription::create([
                            'charge_id'=>$charge_id,
                            'payment_intent_id'=>$payment_intent,
                            'payment_id'=>$customer_payment_method->id,
                            'customer_id'=>$customer_id,
                            'stripe_id' => $subscription->id,
                            'coupon_id'=>0
                        ]);

                        return redirect('/thankyou');
                    }

                }

            }catch (Exception $e) {
                return back()->with('success', $e->getMessage());
            }

        }else{
            $explode = explode('+',$decode_data);
            $coupon = '';
            $coupon_id = 0;

            $email = $explode[0];
            $password = $explode[1];
            $company = $explode[2];
            $vanity_url = $explode[3];
            $package_id = $explode[4];
            $package_state = $explode[5];

            if($explode[6]){
                $coupon_data = Coupon::where('code',$explode[6])->first();
                $coupon = $coupon_data->coupon_code_id;
                $coupon_id = $coupon_data->id;
            }

            $exists = User::where('email',$email)->orwhere('company',$company)->orwhere('company_name',$vanity_url)->first();
            if(!empty($exists)){
                return back()->with('error', '(Email, Company Name, Vanity url) One of the fields have been already taken.');
            }else{
                $country = Country::where('id', $input['country'])->first();
//$get_converted_currency = $country->get_converted_currency($country->currency_code);

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
                            'card_last_four'=>$customer_payment_method->card->last4
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



                            $save_subscription = Subscription::create([
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
                    return back()->with('success', $e->getMessage());
                }
            } 
        }
    }


    public function stripePost_bkp(Request $request) {
        $input = $request->all();
        $decode_data = base64_decode($input['data-key']);

// if($input['existing_user'] !='' && !empty($input['existing_user'])){
//     $explode = explode('+',$decode_data);

//     $email = $explode[0];
//     $company = $explode[1];
//     $vanity_url = $explode[2];
//     $package_id = $explode[3];
//     $package_state = $explode[4];
//     $user_id = $explode[5];

//     $user_detail = User::where('id',$user_id)->first();
//     $customer_id = $user_detail->stripe_id;
//     $subscription = Subscription::where('user_id',$user_id)->where('customer_id',$customer_id)->latest()->first();
//     $subscription_id = $subscription->stripe_id;

//     $country = Country::where('id', $input['country'])->first();
//     $get_converted_currency = $country->get_converted_currency($country->currency_code);

//     $string = $input['plan'];
//     $field = ['stripe_price_id','stripe_price_yearly_id'];
//     $package_info = Package::
//     where(function ($query) use($string, $field) {
//         for ($i = 0; $i < count($field); $i++){
//             $query->orwhere($field[$i], 'LIKE',  '%' . $string .'%');
//         }      
//     })
//     ->first();

//     if($input['plan'] == $package_info->stripe_price_id){
//         $amount  = $package_info->monthly_amount;
//     } else  if($input['plan'] == $package_info->stripe_price_yearly_id){
//         $amount  = $package_info->yearly_amount*12;
//     }

//     $token = $request->stripeToken;

//     try {
//         $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
//         //canceling previous subscription
//         if(($user_detail->subscription_status == 1) && ($subscription->stripe_status == 'active')){

//             $response = $stripe->subscriptions->cancel(
//               $subscription_id,
//               [
//                 'invoice_now'=>true,
//                 'prorate'=>true
//             ]
//         );


//             Subscription::where('stripe_id',$subscription_id)->where('user_id',$user_id)->update([
//                 'canceled_at'=>date('Y-m-d H:i:s',$response->canceled_at),
//                 'ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
//                 'stripe_status'=>$response->status,
//                 'cancel_response'=>json_encode($response,true)
//             ]);

//             User::where('id',$user_detail->id)->update([
//                 'subscription_ends_at'=>date('Y-m-d H:i:s',$response->current_period_end),
//                 'subscription_status'=>1
//             ]);

//             $this->send_cancelled_email($user_detail);
//         }

//         //update with new subscription

//         if (!empty($customer_id)) {
//             $paymentMethod = $stripe->paymentMethods->create([
//                 'type' => 'card',
//                 'card' => ['token' => $token]
//             ]);

//             $customer_payment_method = $stripe->paymentMethods->attach(
//                 $paymentMethod->id, ['customer' => $customer_id]
//             );

//                 $paymentIntents =   $stripe->paymentIntents->create([
//                   'amount' => $amount*100,
//                   'currency' => strtolower($country->currency_code),
//                   'payment_method_types' => ['card'],
//                   'customer'=>$customer_id
//               ]); 





//             $subscription = $stripe->subscriptions->create([
//                 'customer' => $customer_id,
//                 'items' => [
//                     ['price' => $input['plan']],
//                 ],
//                 'default_payment_method' => $customer_payment_method
//             ]);



//             $charge = $stripe->charges->all(['limit' => 1,'customer'=>$customer_id]);

//             if(isset($charge) && !empty($charge->data)){
//                 $charge_id = $charge->data[0]->id;
//                 $payment_intent = $charge->data[0]->payment_intent;
//             }else{
//                 $charge_id = $payment_intent = '';
//             }




//             $user_card_id = UserCard::create([
//                 'user_id'=>$user_id,
//                 'brand'=>$customer_payment_method->card->brand,
//                 'last_four'=>$customer_payment_method->card->last4,
//                 'exp_month'=>$customer_payment_method->card->exp_month,
//                 'exp_year'=>$customer_payment_method->card->exp_year,
//                 'default_type'=>1
//             ]);

//             $user = User::where('id',$user_id)->update([
//                 'name' => ucwords($input['billing_name']),
//                 'default_card_id'=>$user_card_id->id,
//             // 'card_brand'=>$customer_payment_method->card->brand,
//             // 'card_last_four'=>$customer_payment_method->card->last4,
//                 'subscription_status'=>1
//             ]);

//             if ($user) {
//                 $package = Package::where('id', $package_id)->first();
//                 if($package_state == 'month'){
//                     $price = $package->monthly_amount;
//                 }elseif($package_state == 'year'){
//                     $price = $package->yearly_amount*12;
//                 }

//                 UserPackage::create([
//                     'user_id' => $user_id,
//                     'package_id' => $package_id,
//                     'projects' => $package->number_of_projects,
//                     'keywords' => $package->number_of_keywords,
//                     'flag' => '1',
//                     'trial_days' => 0,
//                     'price'=>$price,
//                     'subscription_type'=>$package_state,
//                     'package_purchase' => 1
//                 ]);


//                 UserAddress::where('user_id',$user_id)->update([
//                     'address_line_1' => $input['address_line_1'],
//                     'address_line_2' => $input['address_line_2'],
//                     'city' => $input['city'],
//                     'country' => $input['country'],
//                     'zip' => $input['postal_code']
//                 ]);



//                 $save_subscription = Subscription::create([
//                     'charge_id'=>$charge_id,
//                     'payment_intent_id'=>$payment_intent,
//                     'payment_id'=>$customer_payment_method->id,
//                     'customer_id'=>$customer_id,
//                     'stripe_id' => $subscription->id,
//                     'coupon_id'=>0
//                 ]);

//                 return redirect('/thankyou');
//             }

//         }

//     }catch (Exception $e) {
//         return back()->with('success', $e->getMessage());
//     }

// }else{
        $explode = explode('+',$decode_data);
        $coupon = '';
        $coupon_id = 0;

        $email = $explode[0];
        $password = $explode[1];
        $company = $explode[2];
        $vanity_url = $explode[3];
        $package_id = $explode[4];
        $package_state = $explode[5];

        if($explode[6]){
            $coupon_data = Coupon::where('code',$explode[6])->first();
            $coupon = $coupon_data->coupon_code_id;
            $coupon_id = $coupon_data->id;
        }

        $exists = User::where('email',$email)->orwhere('company',$company)->orwhere('company_name',$vanity_url)->first();
        if(!empty($exists)){
            return back()->with('error', '(Email, Company Name, Vanity url) One of the fields have been already taken.');
        }else{
            $country = Country::where('id', $input['country'])->first();
            $get_converted_currency = $country->get_converted_currency($country->currency_code);

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
                $amount  = $trial_days->monthly_amount*$get_converted_currency;
            } else  if($input['plan'] == $trial_days->stripe_price_yearly_id){
                $amount  = $trial_days->yearly_amount*$get_converted_currency*12;
            }


            $token = $request->stripeToken;

            try {
                $stripe = new \Stripe\StripeClient(\config('app.STRIPE_SECRET'));
                $customer = $stripe->customers->create([
                    'email' => $email,
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

//$paymentMethod = $stripe->paymentMethods->retrieve($paymentMethod->id);

                    $stripe->paymentMethods->attach(
                        $paymentMethod->id, ['customer' => $customer->id]
                    );

// $stripe->paymentMethods->attach([
//     'customer' => $customer->id,
// ]);

                    $customer = $stripe->customers->update($customer->id,[
                        'invoice_settings' => [
                            'default_payment_method' => $paymentMethod->id,
                        ],
                    ]);

                    try {
                        $paymentIntents =   $stripe->paymentIntents->create([
                            'amount' => (int)$amount*100,
                            'currency' => strtolower($country->currency_code),
                            'payment_method_types' => ['card'],
                            'customer'=>$customer->id,
                            'confirmation_method' => 'manual',
                            'confirm' => true,
                            'payment_method'=>$paymentMethod->id,
                            'setup_future_usage'=>'off_session'
                        ]); 

                        $intent = $stripe->paymentIntents->retrieve(
                            $paymentIntents->id
                        );



                        $intent->confirm();

                        $this->generateResponse($intent);

                    } catch (\Exception\ApiErrorException $e) {
                        echo json_encode([
                            'error' => $e->getMessage()
                        ]);
                        echo "catch";
                    }


// die('shruti');
                    $subscription = $stripe->subscriptions->create([
                        'customer' => $customer->id,
                        'items' => [
                            ['price' => $input['plan']],
                        ],
// 'default_payment_method' => $customer_payment_method,
                        'trial_period_days' => $trial_days->duration ?: 0,
                        'coupon'=>$coupon,
                        'off_session'=>TRUE
                    ]);


                    $invoice = $stripe->invoices->retrieve($subscription->latest_invoice); 

// if($invoice->status == 'open'){
//     // echo '<script>';
//     // echo '<script>';
// }

// $charge = $stripe->charges->all(['limit' => 1,'customer'=>$customer->id]);

// if(isset($charge) && !empty($charge->data)){
//     $charge_id = $charge->data[0]->id;
//     $payment_intent = $charge->data[0]->payment_intent;
// }else{
//     $charge_id = $payment_intent = '';
// }


// $user = User::create([
//     'name' => ucwords($input['billing_name']),
//     'email'=>$email,
//     'password'=>Hash::make($password),
//     'role'=>'front',
//     'role_id'=>'2',
//     'company_name'=>strtolower(str_replace(' ','',$vanity_url)),
//     'company'=>trim($company),
//     'stripe_id' => $customer->id
// ]);
// if ($user) {
//     $email_token = base64_encode($user->created_at.$user->id);

//     $user_card_id = UserCard::create([
//         'user_id'=>$user->id,
//         'brand'=>$customer_payment_method->card->brand,
//         'last_four'=>$customer_payment_method->card->last4,
//         'exp_month'=>$customer_payment_method->card->exp_month,
//         'exp_year'=>$customer_payment_method->card->exp_year,
//         'default_type'=>1
//     ]);

//     User::where('id',$user->id)->update(['email_verification_token'=>$email_token,'email_sent_at'=>now(),'default_card_id'=>$user_card_id->id]);

//     $package = Package::where('id', $package_id)->first();
//     if($package_state == 'month'){
//         $price = $package->monthly_amount;
//     }elseif($package_state == 'year'){
//         $price = $package->yearly_amount*12;
//     }

//     UserPackage::create([
//         'user_id' => $user->id,
//         'package_id' => $package_id,
//         'projects' => $package->number_of_projects,
//         'keywords' => $package->number_of_keywords,
//         'flag' => '1',
//         'trial_days' => $package->duration ?: 0,
//         'price'=>$price,
//         'subscription_type'=>$package_state,
//         'package_purchase' => 1
//     ]);


//     UserAddress::create([
//         'user_id' => $user->id,
//         'address_line_1' => $input['address_line_1'],
//         'address_line_2' => $input['address_line_2'],
//         'city' => $input['city'],
//         'country' => $input['country'],
//         'zip' => $input['postal_code']
//     ]);



//     $save_subscription = Subscription::create([
//         'charge_id'=>$charge_id,
//         'payment_intent_id'=>$payment_intent,
//         'payment_id'=>$customer_payment_method->id,
//         'customer_id'=>$customer->id,
//         'stripe_id' => $subscription->id,
//         'coupon_id'=>$coupon_id
//     ]);

//     Auth::loginUsingId($user->id);
//     $this->registeration($user->id);
//     $this->email_verification($user->id);
//     return redirect('/thankyou');
// }

                }
            }catch (Exception $e) {
                return back()->with('success', $e->getMessage());
            }
// } 
        }
    }


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

    public function stripe_new (Request $request){ 
        $user = array();
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
        }else{
            $package_price_id = $result->stripe_price_yearly_id;
            $package_amount = $result->yearly_amount*12;
        }

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


        return view('front.stripe_subscription', ['prices' => $prices,
            'package_price_id' => $package_price_id,
            'countries' => $countries,
            'email' => $email,
            'string'=>$encoded,
            'after_discount'=>$after_discount,
            'package_amount'=>$package_amount,
            'coupon_state'=>$coupon_state,
            'package_state'=>$package_state,
            'user'=>$user,
            'coupon_code'=>$coupon_code
        ]);

    }


    private function generateResponse($intent) {
# Note that if your API version is before 2019-02-11, 'requires_action'
# appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {
# Tell the client to handle the action
            echo "<script> window.location=".$intent->next_action->stripe_js."</script>";


        echo json_encode([
            'requires_action' => true,
            'payment_intent_client_secret' => $intent->client_secret
        ]);
    } else if ($intent->status == 'succeeded') {
# The payment didn’t need any additional actions and completed!
# Handle post-payment fulfillment
        echo json_encode([
            "success" => true
        ]);
    } else {
# Invalid status
        http_response_code(500);
        echo json_encode(['error' => 'Invalid PaymentIntent status']);
    }
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
}