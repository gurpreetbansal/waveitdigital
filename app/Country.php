<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

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
    protected $fillable = ['countries_name','currency_code'];

    public static function get_converted_currency($currency_code){
        $ch = curl_init('https://openexchangerates.org/api/latest.json?app_id=b3c47737dd2546b68359df7a0504fbee');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $exchangeRates = json_decode($json, true);
        if (array_key_exists($currency_code,$exchangeRates['rates']))
        {
          return $exchangeRates['rates'][$currency_code];
        }
        else
        {
          return $exchangeRates['rates']['USD'];
        }
    }

}
