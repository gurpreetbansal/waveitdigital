<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model {

    protected $table = "user_addresses";
    protected $fillable = [
        'user_id', 'address_line_1', 'address_line_2', 'city', 'country', 'zip'
    ];

    protected $appends = array('country_name');
    
    public function getCountryNameAttribute(){
        $data = Country::where('id',$this->country)->first();
        return $data->countries_name;
    }

}