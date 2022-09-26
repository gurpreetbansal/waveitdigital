<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;


use App\SemrushUserAccount;
use App\GoogleAnalyticsUsers;
use App\GoogleUpdate;
use App\Error;

class GoogleAdsCustomer extends Model {


    protected $table = 'google_ads_customers';

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
    protected $fillable = ['user_id','request_id', 'google_ads_id', 'name', 'login_customer_id', 'currencyCode', 'customer_id', 'can_manage_clients','status'];
}