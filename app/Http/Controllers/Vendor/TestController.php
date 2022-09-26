<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Session;
use App\GoogleAnalyticsUsers;
use App\SemrushUserAccount;
use App\SearchConsoleUsers;
use App\SearchConsoleUrl;
use App\User;
use App\Error;

class TestController extends Controller {

	public function connect_search_console(Request $request){
		try{
			$google_redirect_url = \config('app.base_url').'connect_search_console';
			$client = new \Google_Client();
			$client->setAuthConfig(\config('app.FILE_PATH').\config('app.ANALYTICS_CONFIG'));
			$client->setRedirectUri($google_redirect_url);
			$client->addScope(['https://www.googleapis.com/auth/webmasters','https://www.googleapis.com/auth/webmasters.readonly','email','profile']);
			$client->setAccessType("offline");
			$client->setState($request->campaignId.'/'.$request->redirectPage);
			$client->setIncludeGrantedScopes(true);
			$client->setApprovalPrompt('force');


			if ($request->get('code') == NULL) {
				$auth_url = $client->createAuthUrl();
				return redirect()->to($auth_url);
			} else {

				$exploded_value = explode('/',$request->state);
				$campaignId = $exploded_value[0];
				$redirectPage = $exploded_value[1];


				if ($request->get('code')){
					$client->authenticate($request->get('code'));
					$client->refreshToken($request->get('code'));
					Session::put('token', $client->getAccessToken());
					
				}
				if ($request->session()->get('token'))
				{
					$client->setAccessToken($request->session()->get('token'));
				}
				$objOAuthService = new \Google_Service_Oauth2($client);

				if($client->getAccessToken()){
					$getUserDetails = SemrushUserAccount::findorfail($campaignId);
					
					$getLoggedInUser = User::findorfail($getUserDetails->user_id);
					$domainName = $getLoggedInUser->company_name;


					$googleuser = $objOAuthService->userinfo->get();
					$checkIfExists = SearchConsoleUsers::where('user_id',$getUserDetails->user_id)->where('oauth_uid',$googleuser['id'])->first();
					$sessionData = Session::all();



					if(empty($checkIfExists)){
						$insertion = SearchConsoleUsers::create([
							'user_id'=>$getUserDetails->user_id,
							'google_access_token'=> $sessionData['token']['access_token'],
							'google_refresh_token'=>$sessionData['token']['refresh_token'],
							'oauth_uid'=>$googleuser['id'],
							'first_name'=>$googleuser['givenName'],
							'last_name'=>$googleuser['familyName'],
							'email'=>$googleuser['email'],
							'gender'=>$googleuser['gender']??'',
							'locale'=>$googleuser['locale']??'',
							'picture'=>$googleuser['picture']??'',
							'link'=>$googleuser['link']??'',
							'token_type'=>$sessionData['token']['token_type'],
							'expires_in'=>$sessionData['token']['expires_in'],
							'id_token'=>$sessionData['token']['id_token'],
							'service_created'=>$sessionData['token']['created']
						]);

						if($insertion){
							$getLastInsertedId = $insertion->id;
							$updateSemrush = SemrushUserAccount::where('user_id',$getUserDetails->user_id)->where('id',$campaignId)->update([
								'google_console_id'=>$getLastInsertedId
							]);							
							SearchConsoleUsers::updateRefreshNAccessToken($googleuser['email'],$getUserDetails->user_id,$sessionData['token']);
						}

						$service = new \Google_Service_Webmasters($client);
						SearchConsoleUrl::get_console_urls($service,$campaignId,$getLastInsertedId,$getUserDetails->user_id);

					}else if(!empty($sessionData['token']['access_token'])){

						$refresh_token 	= isset($sessionData['token']['refresh_token']) ? $sessionData['token']['refresh_token'] : $checkIfExists->google_refresh_token;
						$update = SearchConsoleUsers::where('user_id',$getUserDetails->user_id)->where('oauth_uid',$googleuser['id'])->where('id',$checkIfExists->id)->update([
							'google_access_token'=> $sessionData['token']['access_token'],
							'google_refresh_token'=> $refresh_token,
							'oauth_uid'=>$googleuser['id'],
							'first_name'=>$googleuser['givenName'],
							'last_name'=>$googleuser['familyName'],
							'email'=>$googleuser['email'],
							'gender'=>$googleuser['gender']??'',
							'locale'=>$googleuser['locale']??'',
							'picture'=>$googleuser['picture']??'',
							'link'=>$googleuser['link']??'',
							'token_type'=>$sessionData['token']['token_type'],
							'expires_in'=>$sessionData['token']['expires_in'],
							'id_token'=>$sessionData['token']['id_token'],
							'service_created'=>$sessionData['token']['created']
						]);
						
						
						if ($client->isAccessTokenExpired()) {
							$client->refreshToken($sessionData['token']['refresh_token']);
						}
						
						SearchConsoleUsers::updateRefreshNAccessToken($googleuser['email'],$getUserDetails->user_id,$sessionData['token']);
						$service = new \Google_Service_Webmasters($client);
						SearchConsoleUrl::get_console_urls($service,$campaignId,$checkIfExists->id,$getUserDetails->user_id);
					}
				}
			}

			echo  "<script>";
			echo "window.close();";
			echo "</script>";
			return;

			/*if($redirectPage == 'authorization'){
				$returnUrl = 'https://'.$domainName.'.'.config('app.APP_DOMAIN').$redirectPage;
			}elseif($redirectPage == 'add-new-project'){
				echo  "<script>";
				echo "window.close();";
				echo "</script>";
				return;
			}else{	
				$returnUrl = 'https://'.$domainName.'.'.config('app.APP_DOMAIN').$redirectPage.'/'.$campaignId;
			}
			return redirect($returnUrl);*/
			
		}catch(Exception $e){
			return $e->getMessage();
		}
	}


	public function check_cron_console(){
        // try{
        $getUser = SemrushUserAccount::
        whereHas('UserInfo', function($q){
          $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
          ->where('subscription_status', 1);
        })  
        ->where('console_account_id','!=',NULL)
        ->where('status',0)
        // ->where('google_console_id',27)
        ->where('id','194')
        ->get();

        
        if(!empty($getUser)){

            /*query variables*/
            $final_query = array();
            $month_query_keys = $month_query_clicks = $month_query_impressions = $month_query_ctr = $month_query_position =  '';
            $three_query_keys = $three_query_clicks = $three_query_impressions = $three_query_ctr = $three_query_position ='';
            $six_query_keys = $six_query_clicks = $six_query_impressions = $six_query_ctr= $six_query_position= '';
            $nine_query_keys = $nine_query_clicks = $nine_query_impressions = $nine_query_ctr = $nine_query_position = '';
            $one_year_query_keys = $one_year_query_clicks = $one_year_query_impressions = $one_year_query_ctr = $one_year_query_position = '';
            $query_dates=$query_converted_dates=    $query_keys = $query_clicks = $query_impressions  = $query_ctr = $query_position   ='';

            $nine_query_array =  $six_query_array = $three_query_array = $one_year_query_array = $month_query_array = $query_array = array();

            /*device variables*/
            $month_device_keys = $month_device_clicks = $month_device_impressions = $month_device_ctr =  $month_device_position =  '';

            $three_device_keys = $three_device_clicks = $three_device_impressions = $three_device_ctr =  $three_device_position =  '';
            $six_device_keys = $six_device_clicks = $six_device_impressions = $six_device_ctr =  $six_device_position =  '';
            $nine_device_keys = $nine_device_clicks = $nine_device_impressions = $nine_device_ctr =  $nine_device_position =  '';
            $year_device_keys = $year_device_clicks = $year_device_impressions = $year_device_ctr =  $year_device_position =  '';
            $two_year_device_keys = $two_year_device_clicks = $two_year_device_impressions = $two_year_device_ctr =  $two_year_device_position =  '';
            $month_device_array = $three_device_array = $six_device_array = $nine_device_array = $year_device_array = $two_year_device_array =  $final_device = array();

            foreach($getUser as $key=>$data){
            	$check = SearchConsoleUrl::checkConsoleData($data->id,$data->user_id,$data->google_console_id,$data->console_account_id);

            	 if(isset($check['status']) && $check['status'] == 0){
            	 	if(!empty($check['message']['error']['code'])){
						if(isset($check['message']['error']['message'])){
							$message = $check['message']['error']['message'];
						}else if(isset($check['message']['message'])){
							$message = $check['message']['message'];
						}else{
							$message = $check['message']['errors'][0]['message'];
						}
					}else if(!empty($check['message']['code'])){
						if(isset($check['message']['message'])){
							$message = $check['message']['message'];
						}else{
							$message = $check['message']['errors'][0]['message'];
						}
					}else{
						$message = $check['message'];
					}
            	 	 Error::create([
		                'request_id'=>$data->id,
		                'code'=>$check['message']['code'],
		                'message'=>$message,
		                'reason'=>$check['message']['errors'][0]['reason'],
		                'module'=>2
		            ]);
            	}else{
                	$getAnalytics  = SearchConsoleUsers::where('id',$data->google_console_id)->first();
                	$user_id = $data->user_id;
                	$campaignId = $data->id;

                	$role_id =User::get_user_role($user_id);

	                if(!empty($getAnalytics)){
	                    $client = GoogleAnalyticsUsers::googleClientAuth($getAnalytics);

	                    $refresh_token  = $getAnalytics->google_refresh_token;

	                    if ($client->isAccessTokenExpired()) {
	                        GoogleAnalyticsUsers::google_refresh_token($client,$refresh_token,$getAnalytics->id);
	                    }

	                    $getAnalyticsId = SearchConsoleUrl::where('id',$data->console_account_id)->first();
	                    $analytics = new \Google_Service_Analytics($client);

	                    $profileUrl = $getAnalyticsId->siteUrl;


	                    $end_date = date('Y-m-d');
	                    $start_date = date('Y-m-d', strtotime("-7 day", strtotime(date('Y-m-d'))));



	                    /*graph data*/

	                    if (file_exists(\config('app.FILE_PATH').'public/search_console/'.$campaignId)) {
	                        $graphfilename = \config('app.FILE_PATH').'public/search_console/'.$campaignId.'/graph.json';
	                        if(file_exists($graphfilename)){
	                            if(date("Y-m-d", filemtime($graphfilename)) != date('Y-m-d')){
	                                $this->search_console_graph_data($client,$profileUrl,$start_date,$end_date,$campaignId);
	                            }
	                        }else{
	                            $this->search_console_graph_data($client,$profileUrl,$start_date,$end_date,$campaignId);
	                        }

	                    }
	                    elseif (!file_exists(\config('app.FILE_PATH').'public/search_console/'.$campaignId)) {
	                        mkdir(\config('app.FILE_PATH').'public/search_console/'.$campaignId, 0777, true);
	                        $this->search_console_graph_data($client,$profileUrl,$start_date,$end_date,$campaignId);
	                    }


	                    /*graph data*/

	                }                   
            	}  
         	}             
        }
        // }catch(\Exception $e){
        //     return $e->getMessage();
        // }

    }


    private function search_console_graph_data($client,$profileUrl,$start_date,$end_date,$campaignId){

        $dates = $converted_dates = $clicks = $impressions = $data_array = array();

        $searchConsoleData = GoogleAnalyticsUsers::getSearchConsoleData($client,$profileUrl,$start_date,$end_date);
        $data = array(
            'campaignId'=>$campaignId,
            'searchConsoleData'=>$searchConsoleData
        );
        echo "<pre>";
        print_r($data);
        echo "===============";
        die;
        
        // file_put_contents(dirname(__FILE__).'/logs/cron_data.txt',print_r($data,true));
        // $data = array();
        // if(!empty($searchConsoleData)){
        //     foreach($searchConsoleData->getRows() as $data_key=>$data){
        //         $dates[] = $data->keys[0];
        //         $converted_dates[] = strtotime($data->keys[0])*1000;
        //         $clicks[]    = array('t'=>strtotime($data->keys[0])*1000,'y'=>$data->clicks);
        //         $impressions[] = array('t'=>strtotime($data->keys[0])*1000,'y'=>$data->impressions);
        //     }

        // }


        // $data_array = array(
        //     'dates'=>$dates,
        //     'converted_dates'=>$converted_dates,
        //     'clicks' =>$clicks,
        //     'impressions'=>$impressions
        // );

        // if (file_exists(\config('app.FILE_PATH').'public/search_console/'.$campaignId)) {
        //     $graphfilename = \config('app.FILE_PATH').'public/search_console/'.$campaignId.'/graph.json';
        //     if(file_exists($graphfilename)){
        //         if(date("Y-m-d", filemtime($graphfilename)) != date('Y-m-d')){
        //             file_put_contents(\config('app.FILE_PATH').'public/search_console/'.$campaignId.'/graph.json', print_r(json_encode($data_array,true),true));
        //         }
        //     }else{
        //         file_put_contents(\config('app.FILE_PATH').'public/search_console/'.$campaignId.'/graph.json', print_r(json_encode($data_array,true),true));
        //     }
        // }
        // elseif (!file_exists(\config('app.FILE_PATH').'public/search_console/'.$campaignId)) {
        //     mkdir(\config('app.FILE_PATH').'public/search_console/'.$campaignId, 0777, true);
        //     file_put_contents(\config('app.FILE_PATH').'public/search_console/'.$campaignId.'/graph.json', print_r(json_encode($data_array,true),true));
        // }
        // $dates = $converted_dates = $clicks = $impressions = array();
    }

}