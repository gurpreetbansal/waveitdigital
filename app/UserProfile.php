<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class UserProfile extends Model {

    protected $table = 'user_profiles';

    protected $appends = array('country_code_val');
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
    protected $fillable = ['user_id', 'agency_name', 'agency_client', 'agency_logo','email', 'contact_no','country_code'];

    public function getCountryCodeValAttribute(){
        $id = $this->country_code;
        if($id <> null){
            $country_data = Country::where('id',$id)->first();
            return  $country_data->country_code;
        }else{
            return '';
        }
    }

    public static function agency_logo($user_id,$image_name){
        if (file_exists(\config('app.FILE_PATH').'public/storage/agency_white_label/'.$user_id)) {
            $path  = 'public/storage/agency_white_label/'.$user_id;
            if(file_exists($path)){
              $image_url = URL::asset('public/storage/agency_white_label/'.$user_id.'/'.$image_name);
            }         
        }else{
            $image_url   =   '';
        }
        return $image_url;   
    }

}
