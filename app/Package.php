<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Package extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'amount', 'image_tag', 'number_of_projects', 'number_of_keywords', 'free_trial', 'duration','monthly_amount','yearly_amount','site_audit_page','stripe_price_yearly_id','status','stripe_price_id','inr_monthly_amount','inr_yearly_amount','inr_product_id','inr_price_monthly_id','inr_price_yearly_id'];


    public  function package_feature(){
        return $this->hasMany('App\PackageFeature');
    }

    public static function package_details($id,$payment_type,$selection_type){
        $amount = $plan_id = 0;
        $package = Package::where('id', $id)->first();
        if(isset($package) && !empty($package)){
            if($selection_type == 'month'){
                $amount = $package->monthly_amount;
                if($payment_type == 'stripe'){
                    $plan_id = $package->stripe_price_id;
                }
                if($payment_type == 'razorpay'){
                    $plan_id = $package->rp_monthly_id;
                }
            }else{
                $amount = $package->yearly_amount;
                if($payment_type == 'stripe'){
                    $plan_id = $package->stripe_price_yearly_id;
                }
                if($payment_type == 'razorpay'){
                    $plan_id = $package->rp_yearly_id;
                }
            }
        }
        return array('amount'=>$amount,'plan_id'=>$plan_id,'package'=>$package);
    }

}
