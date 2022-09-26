<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model {

	protected $table = 'errors';
	
	protected $primaryKey = 'id';
	
	protected $fillable = ['request_id', 'code', 'message','reason','module','response', 'status'];
	

	public static function logData($data = array()){

		/*Error::create([
          'request_id'=>$data['campaignId'],
          'code'=>$error['code'],
          'message'=>$error['error']['message'],
          'reason'=>$error['error']['errors'][0]['reason'],
          'module'=>1
        ]);*/

	}


	public static function removeExisitingError($module,$request_id){
		$ifErrorExists = Error::where('module',$module)->where('request_id',$request_id)->whereDate('updated_at','<=',date('Y-m-d'))->first();
		return $ifErrorExists;
	}
}
