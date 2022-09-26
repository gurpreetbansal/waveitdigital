<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
use App\User;

class RazorpaySubscription extends Model {

	protected $table = 'razorpay_subscriptions';
	protected $primaryKey = 'id';
	protected $fillable = [
		//'user_id', 'plan_id', 'subscription_id', 'payment_id','customer_id','order_id','amount','invoice_id', 'card_id','subscription_interval','current_period_start','current_period_end','subscription_created_date','discount','coupon_name','total_count','remaining_count','short_url','refunded_amount','left_amount','trial_ends_at','canceled_at','payment_status','cancel_response','payment_response'

        'user_id','plan_id','amount','subscription_interval','current_period_start','current_period_end','discount','trial_ends_at','next_invoice_on','reminder_on_1','reminder_on_2','reminder_on_3','canceled_at','payment_status','payment_link_id','payment_link','updated_at','response','canceled_response'
	];

	public function userDetail(){
		return $this->belongsTo('App\User','user_id','id');
	}

	public static function calculate_discount($package_amount,$coupon_data){
		$final = 0.00;
		$percent = $coupon_data->value;
		if($coupon_data->type == 1){
			$calculated_value = number_format(($package_amount * $percent)/100,2);
			if($percent ==100){
				$final = 0.00;
			}else{
				$final = number_format($calculated_value,2);
			}
		}else{
			$final = number_format($coupon_data->value,2);
		}
		
		return $final;
	}
    
	public static function send_cancelled_email($user){
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

    public static function registeration($user_id) {
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

    public static function email_verification($user_id){
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

}