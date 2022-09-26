<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;
use Session;
use App\SemrushUserAccount;
use App\BacklinksData;
use App\BacklinkSummary;
use App\SemrushOrganicMetric;
use App\KeywordSearch;

use App\Traits\ClientAuth;
use Mail;
use App\ApiBalance;
use App\Language;
use App\DfsLocation;

class DataForSeoController extends Controller {

	use ClientAuth;

	public function ajax_organicKeywordRanking(Request $request){	
		$request_id = $request['campaignId'];
		$result  = SemrushOrganicMetric::where('request_id',$request_id)->orderBy('id','desc')->first();
		
		if(isset($result) && !empty($result)){
			$total_count = $result->total_count;
		} else{
			$total_count =0;
		}
		
		$resultOld =  SemrushOrganicMetric::where('request_id',$request_id)->orderBy('id','desc')->offset(1)->limit(1)->first();

		if(!empty($result->total_count) && !empty($resultOld->total_count)){
			if($resultOld->total_count > 2){

				if($resultOld->total_count){
					$organic_keywords = round(($result->total_count-$resultOld->total_count)/$resultOld->total_count * 100, 2);
				} else {
					$organic_keywords = 0;
				}
			} else{
				$organic_keywords	=  100;
			}
		}else if(empty($result->total_count) && !empty($resultOld->total_count) ) {
			$organic_keywords	=  -100;
		} else if(!empty($result->total_count) && empty($resultOld->total_count) ) {
			$organic_keywords	=  100;
		} else{
			$organic_keywords	=  0;
		}
		
		return array('totalCount' => $total_count, 'organic_keywords' => $organic_keywords);
		
	}

	public function check_api_balance(){

		$array = array();
		$balance = 0;
		try {
			$client = $this->DFSAuth();
			$result = $client->get('/v3/appendix/user_data');
			echo "<pre>";
			print_r($result);
			die;

			if(isset($result['tasks'][0]['result'][0]) && !empty($result['tasks'][0]['result'][0])){
				$balance = $result['tasks'][0]['result'][0]['money']['balance'];
				$status_code = $result['status_code'];
				$array = array('status_code'=>$status_code,'balance'=>$balance);

				if(($status_code == '20000') && ($balance <= 50)){
					$data = array('balance'=>$balance);
					Mail::send(['html' => 'mails/dfs_balance'], $data, function($message) {
						$message->to('shruti.dhiman@imarkinfotech.com', 'Shruti Dhiman')->subject('Balance Alert - Data For Seo');
						$message->from(\config('app.mail'), 'Agency Dashboard');
					});

					Mail::send(['html' => 'mails/dfs_balance_new'], $data, function($message) {
						$message->to('ishan@imarkinfotech.com', 'Ishan Gupta')->subject('Balance Alert - Data For Seo');
						$message->from(\config('app.mail'), 'Agency Dashboard');
					});

					$email_sent_flag =1;
					$email_sent_on =now();
				}else{
					$email_sent_flag =0;
					$email_sent_on = NULL;
				}

				ApiBalance::where('name','DFS')->update([
					'balance'=>$balance,
					'email_sent'=>$email_sent_flag,
					'email_sent_on' =>$email_sent_on,
					'status_code'=>$result['tasks'][0]['status_code'],
					'status_message'=>$result['tasks'][0]['status_message']
				]);
			}else{
				ApiBalance::where('name','DFS')->update([
					'status_code'=>$result['tasks'][0]['status_code'],
					'status_message'=>$result['tasks'][0]['status_message']
				]);
			}
		}catch(RestClientException $e){
			return json_decode($e->getMessage(), true);
		}
	}

	public function dfsLanguages(){
		$array = array();
		try {
			$client = $this->DFSAuth();
			$result = $client->get('/v3/serp/google/languages');
			echo "<pre>";
			print_r($result);
			die;
			return json_encode($result);

		}catch(RestClientException $e){
			return json_decode($e->getMessage(), true);
		}
	}

	public function dfsHtml(){

		$array = array();
		$balance = 0;

		$post_array[] = array(
			"language_code" => "en",
			"location_code" => 2840,
			"keyword" => mb_convert_encoding("dental clinic lavender", "UTF-8")
		);
		try {
			$client = $this->DFSAuth();
			/* $result = $client->get('/v3/serp/google/languages');*/

			$result = $client->post('/v3/serp/google/organic/live/html', $post_array);

			file_put_contents(dirname(__FILE__).'/logs/result.html', print_r($result,true));


			print_r($result['tasks'][0]['result'][0]['items'][0]['html']);

            // return json_encode($result);
			return true;

		}catch(RestClientException $e){
			return json_decode($e->getMessage(), true);
		}


	}

	public function dfsJson(){

		$array = array();
		$balance = 0;

		$post_array[] = array(
			"language_code" => "en",
			"location_code" => 2840,
			"keyword" => mb_convert_encoding("dental clinic lavender", "UTF-8")
		);
		try {
			$client = $this->DFSAuth();
			/* $result = $client->get('/v3/serp/google/languages');*/

			$result = $client->post('/v3/serp/google/organic/live/regular', $post_array);


			file_put_contents(dirname(__FILE__).'/logs/result.json', print_r($result,true));


			echo "<pre/>";
			print_r($result);
			die;

            // return json_encode($result);
			return true;

		}catch(RestClientException $e){
			return json_decode($e->getMessage(), true);
		}
	}


	public function ajaxSpyglass(Request $request,$domain=null){

		$encription = base64_decode($domain);
		$encrypted_id = explode('-|-',$encription);
		$keyword_id = $encrypted_id[0];
		$user_id = $encrypted_id[1];
		$current_time = $encrypted_id[2];

		$data = KeywordSearch::where('user_id',$user_id)->where('id',$keyword_id)->first();
		
		$array = array();
		$balance = 0;

		if($data == null){
			return json_encode(array('this keyword page expired.'));
		}

		if(!empty($data->lat) && !empty($data->long)){
			$location = $data->lat.','.$data->long;
			$locationType = "location_coordinate";
		}else{
			if(empty($data->lat) || empty($data->long)){
				$updateLatLong = KeywordSearch::updateKeywordLocationLatLong($request['selected_ids'],$data->canonical);
				
				$location = $updateLatLong;
				$locationType = "location_coordinate";
			}else{
				$location = $data->canonical;
				$locationType = "location_name";
			}
		}
		$post_array[] = array(
			"language_name" => $data->language,
			$locationType => $location,
			"se_domain" => $data->region,
			"domain" => $data->host_url,
			"keyword" => mb_convert_encoding($data->keyword, "UTF-8")
		);

		try {
			$client = $this->DFSAuth();
			/* $result = $client->get('/v3/serp/google/languages');*/

           	/*$urlData = url('/').'/app/Http/Controllers/Vendor/logs/result.html'; 
           	$dom = file_get_contents($urlData);*/
           	
           	$result = $client->post('/v3/serp/google/organic/live/html', $post_array);
           	$dom = $result['tasks'][0]['result'][0]['items'][0]['html']; 


           	return view('vendor.spyglass-ajax',compact('dom','data'))->render();
           	/*print_r($result['tasks'][0]['result'][0]['items'][0]['html']);*/
           	return json_encode($dom);
           }catch(RestClientException $e){
           	return json_decode($e->getMessage(), true);
           }

       }

       public function spyglass(Request $request,$domain=null){


       	$encription = base64_decode($domain);
       	$encrypted_id = explode('-|-',$encription);
       	$keyword_id = $encrypted_id[0];
       	$user_id = $encrypted_id[1];
       	$current_time = $encrypted_id[2];

       	$data = KeywordSearch::where('user_id',$user_id)->where('id',$keyword_id)->first();

       	$array = array();
       	$balance = 0;

       	return view('vendor.spyglass',compact('data','domain'));
       }

	// public function spyglass(Request $request){


	// 	$title = '';
 //    	// Extract HTML using curl

 //    	/*$url = 'https://www.google.com/search?q=ada%20compliant%20kitchen&num=100&hl=en&gl=US&gws_rd=cr&ie=UTF-8&oe=UTF-8&uule=a+cm9sZToxIHByb2R1Y2VyOjEyIHByb3ZlbmFuY2U6NiB0aW1lc3RhbXA6MTYyMzgxNDUwNzAwMDAwMCBsYXRsbmd7IGxhdGl0dWRlX2U3OjM3MDkwMjQwMCBsb25naXR1ZGVfZTc6LTk1NzEyODkxMCB9IHJhZGl1czoxMDAwMDA=';*/
 //    	$url = 'https://www.google.com/search?q=best%20electronic%20water%20softener&num=100&hl=en&gl=US&gws_rd=cr&ie=UTF-8&oe=UTF-8&uule=w+CAIQIFISCQs2MuSEtepUEUK33kOSuTsc';



	// 		$ch = curl_init();
	// 		curl_setopt($ch, CURLOPT_HEADER, 0);
	// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 		curl_setopt($ch, CURLOPT_URL, $url);
	// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// 		@$curldata1 = curl_exec($ch);
	// 		curl_close($ch);

	// 		$curldata = (string) $curldata1;
	// 		/*dd($curldata);*/
	//     	// Load HTML to DOM Object
	// 		$dom = new \DOMDocument();
	// 		@$dom->loadHTML($curldata);
	// 		$div = $dom->	('main');

	//     	// Parse DOM to get Title
	// 		@$nodes = $dom->saveHTML();
	// 		/*echo "<pre/>";print_r($nodes); die;*/
	// 		/*dd($nodes);*/
	// 		/*dd($body);*/
	// 		/*$data = '';*/
	// 		$head = '';
	// 		$body = '';
	// 		$data = @$curldata;



	// 	/*return $title;*/



	// 	/*$ch = curl_init();
	// 	$timeout = 5;
	// 	curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/search?q=outsource%20seo%20to%20india&num=100&hl=en&gl=US&gws_rd=cr&ie=UTF-8&oe=UTF-8&uule=a+cm9sZToxIHByb2R1Y2VyOjEyIHByb3ZlbmFuY2U6NiB0aW1lc3RhbXA6MTYyMTM4MzcyNTAwMDAwMCBsYXRsbmd7IGxhdGl0dWRlX2U3OjM3MDkwMjQwMCBsb25naXR1ZGVfZTc6LTk1NzEyODkxMCB9IHJhZGl1czoxMDAwMDA=');
	// 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	// 	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	// 	$data = curl_exec($ch);
	// 	curl_close($ch);
	// 	dd($data);*/

	// 	return view('vendor.spyglass',compact('head','body','data'));
	// }


       public function keyword_explorer(){

       	$post_array = array();
       	// $post_array[] = array(
       	// 	"location_name" => "United States",
       	// 	"language_name" => "English",
       	// 	"keywords" => array(
       	// 		"seo"
       	// 		// "seo outsourcing company india",
       	// 		// "outsource seo services india"
       	// 		// "seo outsourcing services india",
       	// 		// "seo outsourcing company in india"
       	// 	)
       	// );

   //     	$post_array[] = array(
			//   "location_name" => "United States",
			//   "language_name" => "English",
			//   "category_code" => 13316
			// );

       	$post_array[] = array(
       		"location_name" => "United States",
       		"language_name" => "English",
       		"target" => "seoexpertsindia.com"
       	);
       	try {
       		$client = $this->DFSAuth();
       		// $result = $client->post('/v3/keywords_data/google/keywords_for_keywords/live', $post_array);
       		  // $result = $client->post('/v3/keywords_data/google/keywords_for_category/live', $post_array);
       		$result = $client->post('/v3/keywords_data/google/keywords_for_site/live', $post_array);


       		echo "<pre>";
       		print_r($result);
       		die;
       	} catch (RestClientException $e) {
       		echo "\n";
       		print "HTTP code: {$e->getHttpCode()}\n";
       		print "Error code: {$e->getCode()}\n";
       		print "Message: {$e->getMessage()}\n";
       		print  $e->getTraceAsString();
       		echo "\n";
       	}
       	$client = null;
       }


       public function dfsLocations(){
       	ini_set('memory_limit', '-1');
       	ini_set('max_execution_time', 0); 
       	$array = array();
       	try {
       		$client = $this->DFSAuth();
       		$result = $client->get('/v3/serp/google/locations');
       		echo "<pre>";
       		print_r($result);
       		die;
       		file_put_contents(dirname(__FILE__)."/logs/dfs_locations.json", print_r(json_encode($result),true));
       		return json_encode($result);
       	}catch(RestClientException $e){
       		return json_decode($e->getMessage(), true);
       	}
       }



       public function keyword_for_site_bkp(){
       	$post_array = array();
       	$post_array[] = array(
       		"location_name" => "United States",
       		"language_code" => "en",
       		"target" => "imarkinfotech.com",
       		"search_partners"=> "true",
       		"sort_by"=>"relevance"
       	);
       	try {
       		$client = $this->DFSAuth();
       		$result = $client->post('/v3/keywords_data/google_ads/keywords_for_site/live', $post_array);
       		echo "<pre>";
       		print_r($result);
       		die;
       	} catch (RestClientException $e) {
       		echo "\n";
       		print "HTTP code: {$e->getHttpCode()}\n";
       		print "Error code: {$e->getCode()}\n";
       		print "Message: {$e->getMessage()}\n";
       		print  $e->getTraceAsString();
       		echo "\n";
       	}
       	$client = null;
       }  


       public function keyword_for_site(){
       	ini_set('max_execution_time', 0);
       	ini_set('memory_limit', '-1');
       	$file = file_get_contents(env('APP_URL').'/public/dfs_locations.json');
       	$json = json_decode($file,true);
       	// echo "<pre>";
       	// print_r($json['tasks'][0]['result']);
       	// die;
       	$i = 1;
       	foreach($json['tasks'][0]['result'] as $key=>$value){
       		DfsLocation::updateOrCreate([
       			'location' =>$value['location_name'],
       			'location_code' =>$value['location_code']
       		],[
       			'location' =>$value['location_name'],
       			'location_code' =>$value['location_code'],
       			'country_iso_code' =>$value['country_iso_code'],
       			'location_code_parent' =>$value['location_code_parent'],
       			'location_type' =>$value['location_type']
       		]);
       		if($i%100==0){
       			sleep(2);
       		}
       		$i++;
       	}
       }   

       // public function checkHistory(){
       // 	$client = $this->DFSAuth();
       // 	$post_array = array();
       // 	$post_array[] = array(
       // 		"target" => "imarkinfotech.com"
       // 	);
       // 	try {
       // 		$result = $client->post('/v3/backlinks/history/live', $post_array);
       // 		echo "<pre>";
       // 		print_r($result);
       // 		die;
       // 	} catch (RestClientException $e) {
       // 		echo "n";
       // 		print "HTTP code: {$e->getHttpCode()}n";
       // 		print "Error code: {$e->getCode()}n";
       // 		print "Message: {$e->getMessage()}n";
       // 		print  $e->getTraceAsString();
       // 		echo "n";
       // 	}
       // 	$client = null;
       // }


    public function dfs_backlinks(){
  		$client = $this->DFSAuth();
       	$post_array = array();
       	$post_array[] = array(
		   "target" => "wlp.com.sg",
		   "internal_list_limit" => 10,
		   "include_subdomains" => true,
		   // "backlinks_filters" => ["dofollow", "=", true],
		   "backlinks_status_type" => "all"
		);
       	try {
       		$result = $client->post('/v3/backlinks/summary/live', $post_array);
       		echo "<pre>";
       		print_r($result);
       		die;
       	} catch (RestClientException $e) {
       		echo "n";
       		print "HTTP code: {$e->getHttpCode()}n";
       		print "Error code: {$e->getCode()}n";
       		print "Message: {$e->getMessage()}n";
       		print  $e->getTraceAsString();
       		echo "n";
       	}
       	$client = null;
	}

	public function dfs_backlinks_list(){
  		$client = $this->DFSAuth();
       	$post_array = array();
       	$post_array[] = array(
		   "target" => "wlp.com.sg",
		   "limit" => 20,
		   "mode" => "as_is"
		   // "filters" => ["dofollow", "=", true]
		);
       	try {
       		$result = $client->post('/v3/backlinks/backlinks/live', $post_array);
       		echo "<pre>";
       		print_r($result);
       		die;
       	} catch (RestClientException $e) {
       		echo "n";
       		print "HTTP code: {$e->getHttpCode()}n";
       		print "Error code: {$e->getCode()}n";
       		print "Message: {$e->getMessage()}n";
       		print  $e->getTraceAsString();
       		echo "n";
       	}
       	$client = null;
	}
}