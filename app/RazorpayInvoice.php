<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RazorpayInvoice extends Model {

	protected $table = 'razorpay_invoices';

	protected $primaryKey = 'id';

	protected $fillable = [
		'user_id','order_id','payment_link_id','razorpay_subscription_id','package_id','amount','subscription_interval','current_period_start','current_period_end','payment_link','invoice_number','invoice_date','invoice_status'
	];

	public function razorpaySubscription(){
		return $this->belongsTo('App\RazorpaySubscription','razorpay_subscription_id','id');
	}

	public static function generate_invoice_number($count,$string){
		$lastid = $count+1;
		$id = str_pad($lastid, 4, 0, STR_PAD_LEFT);
		$number = $string.'-'.$id;
		return $number;
	}

	public function userDetail(){
		return $this->belongsTo('App\User','user_id','id');
	}

	public function packageDetail(){
		return $this->belongsTo('App\Package','package_id','id');
	}

	public function userAddress() {
        return $this->hasOne('App\UserAddress', 'user_id', 'id');
    }
}