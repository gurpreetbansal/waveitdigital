<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\GoogleAnalyticsUsers;
use App\User;
use App\SemrushUserAccount;
use App\GoogleAdsCustomer;

/*Google ads*/
use Google\Auth\CredentialsLoader;
use Google\Auth\OAuth2;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;
use React\Http\Message\Response;
use React\Http\Server;
use UnexpectedValueException;

use GetOpt\GetOpt;
use App\Http\Controllers\Vendor\ArgumentNames;
use App\Http\Controllers\Vendor\ArgumentParser;
use Google\Ads\GoogleAds\Lib\V10\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V10\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V10\GoogleAdsException;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V10\GoogleAdsServerStreamDecorator;
use Google\Ads\GoogleAds\V10\Errors\GoogleAdsError;
use Google\Ads\GoogleAds\V10\Resources\CustomerClient;
use Google\Ads\GoogleAds\V10\Services\CustomerServiceClient;
use Google\Ads\GoogleAds\V10\Services\GoogleAdsRow;
use Google\ApiCore\ApiException;

use Google\Ads\GoogleAds\Util\V10\ResourceNames;
use Google\Ads\GoogleAds\Utils\Helper;
use Google\Ads\GoogleAds\V10\Common\ManualCpc;
use Google\Ads\GoogleAds\V10\Common\ManualCpm;
use Google\Ads\GoogleAds\V10\Enums\AdvertisingChannelTypeEnum\AdvertisingChannelType;
use Google\Ads\GoogleAds\V10\Enums\AdServingOptimizationStatusEnum\AdServingOptimizationStatus;
use Google\Ads\GoogleAds\V10\Enums\BudgetDeliveryMethodEnum\BudgetDeliveryMethod;
use Google\Ads\GoogleAds\V10\Enums\CampaignStatusEnum\CampaignStatus;
use Google\Ads\GoogleAds\V10\Resources\Campaign;
use Google\Ads\GoogleAds\V10\Resources\Campaign\NetworkSettings;
use Google\Ads\GoogleAds\V10\Resources\CampaignBudget;
use Google\Ads\GoogleAds\V10\Services\CampaignBudgetOperation;
use Google\Ads\GoogleAds\V10\Services\CampaignOperation;
use Psr\Log\LogLevel;
use Google\Ads\GoogleAds\Lib\V10\LoggerFactory;




class GoogleController extends Controller {
	
	private const PAGE_SIZE = 1000;
	private const CUSTOMER_ID = '7300053848';

	public function __construct(){	
		$this->client_id = \config('app.ads_client_id');
		$this->client_secret = \config('app.ads_client_secret');
		$this->developerToken = \config('app.ads_developerToken');
	}
	
	public function connectGoogleAds (Request $request){
		try {

			$redirectUri = \config('app.base_url').'connect_google_ads';
			$ADWORDS_API_SCOPE = array('https://www.googleapis.com/auth/adwords','email','profile');
			$AUTHORIZATION_URI = 'https://accounts.google.com/o/oauth2/v2/auth';
			$PRODUCTS = [['AdWords', $ADWORDS_API_SCOPE]];
			$scopes = $PRODUCTS[0][1];
			$oauth2 = new OAuth2([
				'authorizationUri' => $AUTHORIZATION_URI,
				'redirectUri' => $redirectUri,
				'tokenCredentialUri' => CredentialsLoader::TOKEN_CREDENTIAL_URI,
				'clientId' => \config('app.ads_client_id'),
				'clientSecret' => \config('app.ads_client_secret'),
				'scope' => $scopes,
				'state'=>$request->campaignId.'/'.$request->redirectPage
			]);


			if($request->get('code')){

				$exploded_value = explode('/',$request->state);
				$campaign_Id = $exploded_value[0];
				$redirectPage = $exploded_value[1];

				$code = $request->get('code');
				$oauth2->setCode($code);
				$oauthInfo = $oauth2->fetchAuthToken();

				$refreshToken = $oauthInfo['refresh_token'];
				$access_token = $oauthInfo['access_token'];
				$timestamp = $oauthInfo['expires_in'];

				$oAuth2Credential = (new OAuth2TokenBuilder())
                            ->withRefreshToken($refreshToken)
                            ->withClientId(\config('app.ads_client_id'))
                            ->withClientSecret(\config('app.ads_client_secret'))
                            ->build();

		        $googleAdsClient = (new GoogleAdsClientBuilder())
		            ->withOAuth2Credential($oAuth2Credential)
		            ->withDeveloperToken(\config('app.ads_developerToken'))
		            ->build();
		       
				if (!empty($refreshToken)) {
					Session::put('oauth_data', $oauthInfo);
					Session::put('refresh_token', $refreshToken);
					Session::put('user_id',$request->get('state'));
					Session::put('token', $oauth2->getAccessToken());

					$refreshToken = $oauth2->getAccessToken();

					if ($request->session()->get('token'))
					{
						$oauth2->setAccessToken($request->session()->get('token'));
					}
					$session_result	= $oauth2->getAccessToken();
					
					$userDetails = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token);
					$googleuser = json_decode($userDetails);
					
					/*fetching details of logged-in user*/
					$getUserDetails = SemrushUserAccount::findorfail($campaign_Id);
					$getLoggedInUser = User::findorfail($getUserDetails->user_id);
					$domainName = $getLoggedInUser->company_name;

					/*if details of google account exists*/					
					$checkIfExists = GoogleAnalyticsUsers::where('user_id',$getUserDetails->user_id)->where('oauth_uid',$googleuser->id)->where('oauth_provider','google_ads')->first();
					
					$sessionData = Session::all();

					if(empty($checkIfExists)){
						$insert = GoogleAnalyticsUsers::create([
							'user_id'=>$getUserDetails->user_id,
							'google_access_token'=> $access_token,
							'google_refresh_token'=>$refreshToken,
							'oauth_provider'=>'google_ads',
							'oauth_uid'=>$googleuser->id,
							'first_name'=>$googleuser->given_name,
							'last_name'=>$googleuser->family_name,
							'email'=>$googleuser->email,
							'gender'=>$googleuser->gender??'',
							'locale'=>$googleuser->locale??'',
							'picture'=>$googleuser->picture??'',
							'link'=>$googleuser->link??'',
							'token_type'=>$sessionData['oauth_data']['token_type'],
							'expires_in'=>$sessionData['oauth_data']['expires_in'],
							'id_token'=>$sessionData['oauth_data']['id_token'],
							'service_created'=>time(),
							'created_at'=>now(),
							'updated_at'=>now()
						]);

						$getLastInsertedId = $insert->id;
						/*adding google ads customer in db*/
						$this->googleAdsAuth($getUserDetails->user_id,$campaign_Id,$getLastInsertedId);
					}else{
						$refresh_token 	= isset($sessionData['oauth_data']['refresh_token']) ? $sessionData['oauth_data']['refresh_token'] : $checkIfExists->google_refresh_token;
						GoogleAnalyticsUsers::where('user_id',$getUserDetails->user_id)->where('oauth_uid',$googleuser->id)->where('oauth_provider','google_ads')->update([
							'google_access_token'=> $access_token,
							'google_refresh_token'=>$refresh_token,
							'oauth_uid'=>$googleuser->id,
							'first_name'=>$googleuser->given_name,
							'last_name'=>$googleuser->family_name,
							'email'=>$googleuser->email,
							'gender'=>$googleuser->gender??'',
							'locale'=>$googleuser->locale??'',
							'picture'=>$googleuser->picture??'',
							'link'=>$googleuser->link??'',
							'token_type'=>$sessionData['oauth_data']['token_type'],
							'expires_in'=>$sessionData['oauth_data']['expires_in'],
							'id_token'=>$sessionData['oauth_data']['id_token'],
							'service_created'=>time(),
							'created_at'=>now(),
							'updated_at'=>now()
						]);
						/*adding google ads customer in db*/
						$this->googleAdsAuth($getUserDetails->user_id,$campaign_Id,$checkIfExists->id);
					}

					if($redirectPage == 'campaign-detail' || $redirectPage == 'project-settings' || $redirectPage == 'add-new-project'){
						echo  "<script>";
						echo "window.close();";
						echo "</script>";
						return;	
					}
				} else {
					echo "Error please go back and try again.";
					exit;
				}
			} else {
	
				$extra_para = ['access_type' => 'offline','prompt'=>'consent'];
				$google_login_authUrl = $oauth2->buildFullAuthorizationUri($extra_para);
				return redirect()->to($google_login_authUrl);

			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function googleAdsAuth($user_id,$campaign_Id,$google_ads_id){
		$session_data = Session::all();

		try {
			
			$oAuth2Credential = (new OAuth2TokenBuilder())
			->withClientId(\config('app.ads_client_id'))
			->withClientSecret(\config('app.ads_client_secret'))
			->withRefreshToken($session_data['refresh_token'])
			->build();

			$googleAdsClient = (new GoogleAdsClientBuilder())
			->withDeveloperToken(\config('app.ads_developerToken'))
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

            $postRequest = array(
			    'token' => $session_data['token']
			);

			$customerServiceClient = $googleAdsClient->getCustomerServiceClient();
        	$accessibleCustomers = $customerServiceClient->listAccessibleCustomers();



        	/*foreach ($accessibleCustomers->getResourceNames() as $customerResourceName) {
	            $customer = CustomerServiceClient::parseName($customerResourceName)['customer_id'];
	            print $customer . PHP_EOL;
	            $accessibleCustomerIds[] = intval($customer);
	        }*/

        	$active_customers = [];
	        $error_customers = [];
	        $i = 0;
	        $query = 'SELECT customer.id, customer.descriptive_name, customer.currency_code, customer.time_zone, customer.tracking_url_template, customer.auto_tagging_enabled FROM customer LIMIT 1';

	        $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();

	        foreach ($accessibleCustomers->getResourceNames() as $resourceName) {


	            $customer_id = CustomerServiceClient::parseName($resourceName)['customer_id'];

	            // $customer = $googleAdsServiceClient->searchStream($customer_id, $query);
	            // $customer = $googleAdsServiceClient->search($customer_id, $query)->getIterator()->current()->getCustomer();
	            
	            try{
	              	// $customer = $customerServiceClient->getCustomer(ResourceNames::forCustomer($customer_id));
	                // $customer = $googleAdsServiceClient->search($customer_id, $query)->getIterator()->current()->getCustomer();
	                $customer = $googleAdsServiceClient->search($customer_id, $query)->getIterator()->current()->getCustomer();
	                $active_customers[$i]['customerId'] = $customer->getId();
	                $active_customers[$i]['is_manager'] = $customer->getManager();
	                $active_customers[$i]['account_name'] = $customer->getDescriptiveName();
	                $active_customers[$i]['currencyCode'] = $customer->getCurrencyCode();
	                $active_customers[$i]['account_time_zone'] = $customer->getTimeZone();
	            }catch (GoogleAdsException $googleAdsException) {
	                $error_customers['resource_name'] = $resourceName;
	                foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
	                    $error_customers['error_code'] = $error->getErrorCode()->getErrorCode();
	                    $error_customers['message'] = $error->getMessage();
	                }
	            }

	            
	            $i++;
	        }
	        $i = 0;
	        $child_accounts = [];
	        if(!empty($active_customers)){
	            foreach ($active_customers as $customer_info) {
	                try {
	                    $account_information = [];
	                    if($customer_info['is_manager'] == 1){
	                        $loginCustomerId = $customer_info['customerId'];
	                        $clients = self::get_client_ids_data($googleAdsClient,$loginCustomerId,$refreshToken);
	                        if(!empty($clients)){
	                            foreach($clients as $val){
	                                foreach($val as $v){
	                                    $child_account =  [
	                                        'customerId' => $v['customerId'],        
	                                        'is_manager' => $v['is_manager'],
	                                        'account_name' => $v['descriptiveName'],
	                                        'account_time_zone' => $v['timezone'],
	                                        'currencyCode' => $v['currencyCode'],
	                                        'manager_id'=>$loginCustomerId
	                                    ];
	                                    array_push($child_accounts,$child_account);
	                                }
	                            }
	                        }
	                    }
	                } catch(Exception $e) {
	                    //echo 'Message: ' . $e->getMessage();
	                }
	                $i++;
	            }
	        }

	        $all_accounts = array_merge($child_accounts,$active_customers);

	        $temp = [];
	        $final_acc = [];
	        foreach($all_accounts as $c){
	            if(!in_array($c['customerId'],$temp)){
	                array_push($temp,$c['customerId']);
	                $final_acc[] = $c;
	            }
	        }

	        echo "<pre/>"; 
	        print_r($final_acc);
	        die;

            $cURLConnection = curl_init('https://agencydashboard.io/ppc/campains.php');
			curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);


			$apiResponse = curl_exec($cURLConnection);
			curl_close($cURLConnection);

			// $apiResponse - available data from the API request
			// $jsonArrayResponse = json_decode($apiResponse);
			
			$apiResponseList = json_decode($apiResponse,true);
			
			if($apiResponseList <> null){

				 /*GoogleAdsCustomer::where('user_id',$user_id)->where('google_ads_id',$google_ads_id)->where('request_id',$campaign_Id)->delete();*/

				foreach ($apiResponseList as $key => $value) {

					$array = array();
					$checkIfExists = GoogleAdsCustomer::where('user_id',$user_id)->where('customer_id',$value['customerId'])->first();
					$array = [
						'user_id'=> $user_id,
						'request_id'=>$campaign_Id,
						'google_ads_id'=>$google_ads_id,
						'name'=>$value['account_name'],
						'customer_id'=>$value['customerId'],
						'can_manage_clients'=>$value['is_manager'] ?:0
					];
					if(empty($checkIfExists)){

						GoogleAdsCustomer::create($array);
						$array = array();
					}else{
						$updateSemrush = GoogleAdsCustomer::where('id',$checkIfExists->id)->update($array);	
					}
					
				}
		
				file_put_contents(dirname(__FILE__)."/logs/googleads_data.txt", print_r($array,true));

				return true;
			} else{
				return false;
			}


		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/*april 30*/
	public function ajax_refresh_ppc_acccount_list(Request $request){
		$response = array();
		$campaign_Id = $request->campaign_id;
		$email_id = $request->email;
		$user_id = User::get_parent_user_id(Auth::user()->id); 
		if($campaign_Id <> null){
			$checkIfExists = GoogleAnalyticsUsers::where('id',$email_id)->where('user_id',$user_id)->where('oauth_provider','google_ads')->first();

			if(!empty($checkIfExists)){
				$data = $this->googleAdsAuth_refresh($user_id,$campaign_Id,$checkIfExists->id,$checkIfExists->google_refresh_token);

				if($data['status']== 1){
					$response['status'] = 1;
					$response['time'] = 'Last fetched now';
				}
				if($data['status']== 2){
					$response['status'] = 0;
					$response['time'] = 'Error message: '.$data['message'];
				}
			}else{
				$response['status'] = 2;
				$response['time'] = 'Error: Please try again.';
			}
		}else{
			$response['status'] = 2;
			$response['time'] = 'Error: missing campaign id';
			
		}
		return response()->json($response);
	}

	private function googleAdsAuth_refresh($user_id,$campaign_Id,$google_ads_id,$refresh_token){
		$response = array();
		// try {
			
			$oAuth2Credential = (new OAuth2TokenBuilder())
			->withClientId(\config('app.ads_client_id'))
			->withClientSecret(\config('app.ads_client_secret'))
			->withRefreshToken($refresh_token)
			->build();
			// $session = (new AdWordsSessionBuilder())
			// ->withDeveloperToken(\config('app.ads_developerToken'))
			// ->withOAuth2Credential($oAuth2Credential)
			// ->build();

			$googleAdsClient = (new GoogleAdsClientBuilder())
			->withDeveloperToken(\config('app.ads_developerToken'))
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

            $postRequest = array(
			    'token' => $refresh_token
			);
            
            $cURLConnection = curl_init('https://imarks.xyz/ppc/campains.php');
			curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);

			$apiResponse = curl_exec($cURLConnection);
			curl_close($cURLConnection);

			// $apiResponse - available data from the API request
			// $jsonArrayResponse = json_decode($apiResponse);
			
			$apiResponseList = json_decode($apiResponse,true);
			
			if($apiResponseList <> null){

				 /*GoogleAdsCustomer::where('user_id',$user_id)->where('google_ads_id',$google_ads_id)->where('request_id',$campaign_Id)->delete();*/

				foreach ($apiResponseList as $key => $value) {

					$array = array();
					$checkIfExists = GoogleAdsCustomer::where('user_id',$user_id)->where('customer_id',$value['customerId'])->first();
					$array = [
						'user_id'=> $user_id,
						'request_id'=>$campaign_Id,
						'google_ads_id'=>$google_ads_id,
						'name'=>$value['account_name'],
						'customer_id'=>$value['customerId'],
						'can_manage_clients'=>$value['is_manager'] ?:0
					];
					if(empty($checkIfExists)){

						GoogleAdsCustomer::create($array);
						$array = array();
					}else{
						$updateSemrush = GoogleAdsCustomer::where('id',$checkIfExists->id)->update($array);	
					}


					/*$array = array();
					$array = [
						'user_id'=> $user_id,
						'request_id'=>$campaign_Id,
						'google_ads_id'=>$google_ads_id,
						'name'=>$value['account_name'],
						'customer_id'=>$value['customerId'],
						'can_manage_clients'=>$value['is_manager'] ?:0
					];
					
					GoogleAdsCustomer::create($array);
					$array = array();*/
				}
		
				/*file_put_contents(dirname(__FILE__)."/logs/googleads_data.txt", print_r($array,true));*/

				$response['status'] = 1;
			} else{
				$response['status'] = 0;
			}

			return $response;
		// } catch (Exception $e) {
		// 	$error = $e->getMessage();
		// 	$response['status'] = 2;
		// 	$response['message'] = $error;
		// 	return $response;
		// }
	}

}