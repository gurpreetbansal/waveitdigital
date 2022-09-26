<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\SemrushUserAccount;

class WebsiteMonitoringController extends Controller {

	public function website_monitoring(){
		$res = $data = array();
		$projects = SemrushUserAccount::
		where('status',0)
		->whereHas('UserInfo', function($q){
			$q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
			->where('subscription_status', 1);
		})
		->select('id','user_id','domain_name','domain_url','host_url')
		->orderBy('id','asc')
		->skip(100)
		->take(100)
		->get();
		


		//$projects = array('shosty.com','bengalcatskittens.co.uk','slyelectrical.com.au','apexcwm.com','svmplus.com','embellalife.com','enhanceimage.com','gayraleighrealtor.com','epiphanyprofessional.com','toledorenovations.com','techlinelandscaping.com','businessbuildersconnection.com','acceleratecash4cars.com','websitedesignsservices.com.au');
		
		if(isset($projects) && !empty($projects)){
			foreach($projects as $key=>$value){

				if( !$this->checkOnline( $value->host_url ) ) {
					$res[] =  $value->host_url ." is down!";
				}else{
					$res[] =  $value->host_url ." is up!";
				}
			}
		}

		echo "<pre>";
		print_r($res);
		die;


			foreach ($projects as $server){
				$url = $server->host_url;
				$pingTime = $this->pingDomain($url);
				if($pingTime){ # it's online
					echo $url." (".$pingTime."ms - online)".'</br>';
				} else {
					echo $url." (Offline)".'</br>';
				}
			}
	}

	function pingDomain($domain){
	    $start_time = microtime(true);
	    $file      = @fsockopen ($domain, 80, $errno, $errstr, 10);
	    $end_time  = microtime(true);

	    if ($file){ # We connected ok.
	        fclose($file);
	        return floor(($end_time - $start_time) * 1000);
	    }
	    return false;
	}



	function checkOnline($domain) {
		$curlInit = curl_init($domain);
		curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
		curl_setopt($curlInit,CURLOPT_HEADER,true);
		curl_setopt($curlInit,CURLOPT_NOBODY,true);
		curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($curlInit);
		curl_close($curlInit);
		if ($response) return true;
		return false;
	}

	private function url_test($url) {
		$timeout = 10;
		$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		$http_respond = curl_exec($ch);
		$http_respond = trim( strip_tags( $http_respond ) );
		$http_code = curl_getinfo( $ch ,CURLINFO_HTTP_CODE);		
		if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
			return $http_code;
		} else {
			return $http_code;
		}
		curl_close( $ch );
	}

	function Visit($url){
		$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
		curl_setopt ($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch,CURLOPT_VERBOSE,false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch,CURLOPT_SSLVERSION,3);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
		$page=curl_exec($ch);
       //echo curl_error($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode>=200 && $httpcode<300) return true;
		else return false;
	}

	function defaultSocket($url){
		ini_set("default_socket_timeout","05");
		set_time_limit(5);
		$f=fopen($url,"r");
		$r=fread($f,1000);
		fclose($f);
		if(strlen($r)>1) {
			return true;
		}
		else {
			return false;
		}
	}
}