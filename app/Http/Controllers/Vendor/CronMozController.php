<?php 

namespace App\Http\Controllers\Vendor;
use App\Http\Controllers\Controller;
use App\SemrushUserAccount;
use App\Moz;


class CronMozController extends Controller {

	public function check_moz_cron(){
		$insertMozData = Moz::getMozData('littlezaks.com.au');

		echo "<pre>";
		print_r($insertMozData);
		die;
		$request_data = SemrushUserAccount::
		whereHas('UserInfo', function($q){
			$q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
			->where('subscription_status', 1);
		})  
		->select('id','user_id','domain_url')->where('status','0')->get();

		

		if(!empty($request_data) && isset($request_data)){
			foreach($request_data  as $semrush_data){
				$data = Moz::
				whereMonth('created_at','=',date('m'))
				->whereYear('created_at','=',date('Y'))
				->where('request_id',$semrush_data->id)
				->orderBy('id','desc')
				->first();


				if(empty($data) && $data == null){
					$domain_url = rtrim($semrush_data->domain_url, '/');
					$insertMozData = Moz::getMozData($semrush_data->domain_url);
					if ($insertMozData) {
						Moz::create([
							'user_id' => $semrush_data->user_id,
							'request_id' => $semrush_data->id,
							'domain_authority' => $insertMozData->DomainAuthority,
							'page_authority' => $insertMozData->PageAuthority,
							'status' => 0
						]);
					}

				}   
			}       
		}
	}
}