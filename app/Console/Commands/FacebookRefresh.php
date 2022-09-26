<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Logic\Providers\FacebookRepository;
use App\Social\{SocialAccount,FacebookUserPage};
use App\{User,SemrushUserAccount,Country,GoogleUpdate,KeywordPosition,Error};

use App\Http\Controllers\Social\SocialController;

class FacebookRefresh extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	protected $signature = 'Facebook:Refresh';

	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Refresh Facebook Data';

	/**
	* Create a new command instance.
	*
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
	}


	public function handle(){
		try{
            $getUser = SemrushUserAccount::
            whereHas('UserInfo', function($q){
                $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
                ->where('subscription_status', 1);
            })
            ->whereDoesntHave('GoogleUpdates', function ($q) {
                $q->whereDate('facebook',date('Y-m-d'));
            }) 
            ->whereDoesntHave('GoogleErrors', function ($q) {
                $q->where('module',6)
                ->whereDate('updated_at',date('Y-m-d'));
            })  
            ->where('status','0')
            ->whereNotNull('facebook_page_id')
            ->whereNotNull('fbid')
            ->get();

            $refreshFacebook = new FacebookRepository();

            if (!$getUser->isEmpty())
            {
                foreach($getUser as $gtUser){
                    $campaignId = $gtUser->id;

                    //Update Token
                    $getSocial = SocialAccount::where('id',$gtUser->fbid)->select('access_token')->first();
                    $token = $refreshFacebook->getLongLivedToken($getSocial->access_token);
                    if(!empty($token['error'])){
                        //Log error in update token
                        Error::updateOrCreate(
                            ['request_id' => $campaignId,'module'=> 6],
                            ['response'=> json_encode($token['error']),'request_id' => $campaignId,'module'=> 6]
                        );
                    }else{
                        //get user profile and update
                        $oathUser = $refreshFacebook->getOathUserProfile($token);
                        $updateAccount = SocialAccount::where('id',$gtUser->fbid)->update(['access_token' => $token, 'oauth_uid' => $oathUser['id'], 'name' => $oathUser['name'], 'first_name' => $oathUser['first_name'], 'last_name' => $oathUser['last_name']]);
                        $pages = $refreshFacebook->getUserPages($token);
                        if(!empty($pages)){

                            //Create and update pages
                            foreach ($pages as  $value) {
                                $data[] = $value['name'];
                                $check = FacebookUserPage::select('id')->where([['fbid', $gtUser->fbid],['page_id',$value['id']]])->exists();
                                if ($check) {
                                    FacebookUserPage::where([['fbid', $gtUser->fbid],['page_id',$value['id']]])->update([
                                        'page_name' => $value['name'],
                                        'page_token' => $value['access_token'],
                                        'page_image' => $value['image']
                                    ]);
                                }else{
                                    FacebookUserPage::create([
                                        'fbid' => $gtUser->fbid,
                                        'page_id' => $value['id'],
                                        'page_name' => $value['name'],
                                        'page_token' => $value['access_token'],
                                        'page_image' => $value['image']
                                    ]);
                                }
                            }


                            /*check pages which no longer*/
                            $query = FacebookUserPage::whereNotIn('page_name',$data)->where('fbid',$gtUser->fbid)->get();
                            if (!$query->isEmpty()){
                                foreach ($query as $getpages) {
                                    $pageId[] = $getpages->page_id;
                                }
                                
                                /*check if no longer pages is attached with user account*/
                                $checkConnectedPage = SemrushUserAccount::where('fbid',$gtUser->fbid)->whereIn('facebook_page_id',$pageId)->get();
                                if (!$checkConnectedPage->isEmpty()){
                                    //Remove page access from everywhere
                                    foreach ($checkConnectedPage as $values) {
                                        SemrushUserAccount::where('id',$values->id)->update([
                                            'facebook_page_id'=>NULL,
                                            'fbid'=>NULL
                                        ]);

                                        if (file_exists(env('FILE_PATH').'public/facebook/'.$values->id)) {
                                            SemrushUserAccount::remove_directory(env('FILE_PATH').'public/facebook/'.$values->id);
                                        }

                                        FacebookUserPage::where('fbid',$values->fbid)->where('page_id',$values->facebook_page_id)->delete();
                                    }
                                }else{
                                    FacebookUserPage::where('fbid',$gtUser->fbid)->whereIn('page_id',$pageId)->delete();
                                }
                            }


                            //Log data
                            $pageToken = FacebookUserPage::where('id',$gtUser->facebook_page_id)->select('page_token','page_id')->first();
                            if(!empty($pageToken)){

                                $getDates = $this->convertDatetoTimestamp();
                                $durationType = 'day';

                                /* Create directory*/
                                if (!file_exists(\config('app.FILE_PATH').'public/facebook/'.$campaignId)) {
                                    mkdir(\config('app.FILE_PATH').'public/facebook/'.$campaignId, 0777, true);
                                }
                               
                                /* Facebook Page Total Likes */
                                $totalLikes = 'page_fan_adds_unique';
                                $fileName   = '/total_page_likes.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$totalLikes,$campaignId,$fileName);

                                /*Facebook Page Organic and paid likes*/
                                $pageOrganicPaidLikes = 'page_fans_by_like_source_unique';
                                $fileName   = '/page_organic_paid_likes.json';
                                $query = $this->createOrganicPaidLikesData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageOrganicPaidLikes,$campaignId,$fileName);

                                /* Facebook Page GenderWise Likes */
                                $genderLikes = 'page_fans_gender_age';
                                $fileName   = '/page_gender_likes.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$genderLikes,$campaignId,$fileName);

                                /* Facebook Page Country Likes */
                                $pageCountryLikes = 'page_fans_country';
                                $fileName   = '/page_country_likes.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageCountryLikes,$campaignId,$fileName);
                           
                                /* Facebook Page City Likes */
                                $pageCityLikes = 'page_fans_city';
                                $fileName   = '/page_city_likes.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageCityLikes,$campaignId,$fileName);

                                /* Facebook Page Language Likes */
                                $pageLanguagesLikes = 'page_fans_locale';
                                $fileName   = '/page_language_likes.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageLanguagesLikes,$campaignId,$fileName);

                                /*Facebook Page Total Engagement*/
                                // $pageEngaged = 'page_engaged_users';
                                // $fileName   = '/page_engaged.json';
                                // $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageEngaged,$campaignId,$fileName);

                                /*Total Impressions*/
                                $pageTotalImpressions = 'page_impressions_unique';
                                $fileName   = '/total_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$pageTotalImpressions,$campaignId,$fileName);

                                /*Organic Impressions*/
                                $organicImpressions = 'page_impressions_organic_unique';
                                $fileName   = '/organic_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$organicImpressions,$campaignId,$fileName);

                                /*Paid Impressions*/
                                $paidImpressions = 'page_impressions_paid_unique';
                                $fileName   = '/paid_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$paidImpressions,$campaignId,$fileName);

                                /*GenderWise Impressions*/
                                $genderWiseImpressions = 'page_impressions_by_age_gender_unique';
                                $fileName   = '/genderwise_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$genderWiseImpressions,$campaignId,$fileName);

                                /*CountryWise Impressions*/
                                $countryWiseImpressions = 'page_impressions_by_country_unique';
                                $fileName   = '/countrywise_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$countryWiseImpressions,$campaignId,$fileName);

                                /*CityWise Impressions*/
                                $cityWiseImpressions = 'page_impressions_by_city_unique';
                                $fileName   = '/citywise_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$cityWiseImpressions,$campaignId,$fileName);

                                /*LocaleWise Impressions*/
                                $localeWiseImpressions = 'page_impressions_by_locale_unique';
                                $fileName   = '/localewise_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$localeWiseImpressions,$campaignId,$fileName);

                                /*Paid video Impressions*/
                                $paidVideoImpressions = 'page_video_views_paid';
                                $fileName   = '/paidvideo_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$paidVideoImpressions,$campaignId,$fileName);

                                /*Organic video Impressions*/
                                $organicVideoImpressions = 'page_video_views_organic';
                                $fileName   = '/organicvideo_impressions.json';
                                $query = $this->createData($pageToken->page_id,$pageToken->page_token,$getDates['since'],$getDates['until'],$durationType,$organicVideoImpressions,$campaignId,$fileName);

                                /*Facebook Page Total reviews*/
                                $pageReviews = 'ratings?fields=created_time,has_rating,has_review,rating,recommendation_type,review_text,reviewer{id,name,picture}';
                                // $pageReviews = 'ratings';
                                $fileName   = '/page_reviews.json';
                                $query = $this->createPageReviewData($pageToken->page_id,$pageToken->page_token,$pageReviews,$campaignId,$fileName);

                                /*Facebook Page Posts*/
                                $pagePostsInsights = 'posts';
                                $fileName   = '/page_posts.json';
                                $limit      = 18;
                                $query = $this->createPagePostData($pageToken->page_id,$pageToken->page_token,$pagePostsInsights,$campaignId,$fileName,$limit);

                                GoogleUpdate::updateTiming($campaignId,'facebook','facebook_type','1');

                                $ifErrorExists = Error::removeExisitingError(6,$campaignId);
                                if(!empty($ifErrorExists)){
                                    Error::where('id',$ifErrorExists->id)->delete();
                                }

                                if($query != 1){
                                    Error::updateOrCreate(
                                        ['request_id' => $campaignId,'module'=> 6],
                                        ['response'=> json_encode($query),'request_id' => $campaignId,'module'=> 6]
                                    );
                                }

                            }
                            
                        }

                    }

                }
                    
                return  response()->json(['status' => 'success', 'message' => 'Data successfully logged']);
            }
            return  response()->json(['status' => 'success', 'message' => 'No User Found']);
        }catch(\Exception $e){
            Error::updateOrCreate(
                ['request_id' => $campaignId,'module'=> 6],
                ['response'=> json_encode($e->getMessage()),'request_id' => $campaignId,'module'=> 6]
            );

            return  response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
	}


	public function convertDatetoTimestamp(){
        $newDate = date('Y-m-d', strtotime(date('Y-m-d'). ' -2 year'));
        $startDate = date('Y-m-d', strtotime($newDate. ' - 1 day'));
        $endDate = date('Y-m-d',strtotime($newDate.'+ 3 months'));
        return ['since' => strtotime($startDate),'until' => strtotime($endDate)];
    }


    /*Get data from facebook and store in json*/
    public function createData($pageId,$pageToken,$since,$until,$durationType,$scope,$campaignId,$fileName){
        try{
        	$refreshFacebook = new FacebookRepository();
            $getData = $refreshFacebook->getData($pageId,$pageToken,$since,$until,$durationType,$scope,$campaignId);
            $data = [];
            if(count($getData) > 0){
                foreach ($getData as $key => $dataValues) {
                    foreach ($dataValues['values'] as $value) {
                        $convertDate = json_decode(json_encode($value['end_time']), true);
                        $date = date('Ymd',strtotime($convertDate['date']));
                        $data[$date] = $value['value'];
                    }
                }
            }
            
            if (!file_exists(\config('app.FILE_PATH').'public/facebook/'.$campaignId)) {
                mkdir(\config('app.FILE_PATH').'public/facebook/'.$campaignId, 0777, true);
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }else{
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }
            return true;
        }catch(\Exception $e){

            Error::updateOrCreate(
                ['request_id' => $campaignId,'module'=> 6],
                ['response'=> json_encode($e->getMessage()),'request_id' => $campaignId,'module'=> 6]
            );

            return $e->getMessage();
        }
    }


    public function createOrganicPaidLikesData($pageId,$pageToken,$since,$until,$durationType,$scope,$campaignId,$fileName){
        try{
        	$refreshFacebook = new FacebookRepository();
            $getData = $refreshFacebook->getData($pageId,$pageToken,$since,$until,$durationType,$scope,$campaignId);
            $data = [];
            if(count($getData) > 0){
                foreach ($getData as $key => $dataValues) {
                    foreach ($dataValues['values'] as $value) {
                        $convertDate = json_decode(json_encode($value['end_time']), true);
                        $date = date('Ymd',strtotime($convertDate['date']));
                        
                        $dataArrange = [
                            'newsFeed' => $value['value']['News Feed'] ?? 0,
                            'pagesuggestions' => $value['value']['Page Suggestions'] ?? 0,
                            'restoredLikes' => $value['value']['Restored Likes from Reactivated Accounts'] ?? 0,
                            'search' => $value['value']['Search'] ?? 0,
                            'yourPage' => $value['value']['Your Page'] ?? 0,
                            'ads' => $value['value']['Ads'] ?? 0
                        ];
                        $data[$date] = $dataArrange;
                    }
                }
            }
            
            if (!file_exists(\config('app.FILE_PATH').'public/facebook/'.$campaignId)) {
                mkdir(\config('app.FILE_PATH').'public/facebook/'.$campaignId, 0777, true);
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }else{
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }

            return true;
        }catch(\Exception $e){ 
            Error::updateOrCreate(
                ['request_id' => $campaignId,'module'=> 6],
                ['response'=> json_encode($e->getMessage()),'request_id' => $campaignId,'module'=> 6]
            );
            return $e->getMessage();
        }
    }



    public function createPageReviewData($pageId,$pageToken,$scope,$campaignId,$fileName){
        try{
        	$refreshFacebook = new FacebookRepository();
            $getData = $refreshFacebook->getPageReviewData($pageId,$pageToken,$scope,$campaignId);
            $data = [];
            if(count($getData) > 0){
                foreach ($getData as $value) {
                    $convertDate = json_decode(json_encode($value['created_time']), true);
                    $date = date('Ymd',strtotime($convertDate['date']));
                    $data[$date] = [
                        'recommendation' => $value['recommendation_type'],
                        'review_text' => $value['review_text'] ?? '',
                        'rating' => $value['rating'] ?? 0,
                        'date' => $date,
                        'reviewer' => $value['reviewer']['name'] ?? 'N/A',
                        'reviewerimage' => $value['reviewer']['picture']['url'] ?? ''
                    ];
                }
            }

            if (!file_exists(\config('app.FILE_PATH').'public/facebook/'.$campaignId)) {
                mkdir(\config('app.FILE_PATH').'public/facebook/'.$campaignId, 0777, true);
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }else{
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }
            return true;
        }catch(\Exception $e){ 
            Error::updateOrCreate(
                ['request_id' => $campaignId,'module'=> 6],
                ['response'=> json_encode($e->getMessage()),'request_id' => $campaignId,'module'=> 6]
            );
            return $e->getMessage();
        }
    }

    public function createPagePostData($pageId,$pageToken,$pagePostsInsights,$campaignId,$fileName,$limit){
        try{
        	$refreshFacebook = new FacebookRepository();
            $getData = $refreshFacebook->fetchPagePosts($pageId,$pageToken,$pagePostsInsights,$campaignId,$limit);
            $data = [];
            if(count($getData) > 0){
                $metrics = '/insights?metric=post_engaged_users,post_impressions_fan_unique';
                foreach ($getData as $value) {
                    $convertDate = json_decode(json_encode($value['created_time']), true);
                    $date = date('Ymd',strtotime($convertDate['date']));
                    $fetchMetics = $refreshFacebook->getPostMetrics($value['id'],$pageToken,$metrics);
                    try{
                        $post_engaged_users = $fetchMetics[0]['values'][0]['value'] ?? 0;
                        $post_impressions_fan_unique = $fetchMetics[2]['values'][0]['value'] ?? 0;
                    }catch(\Exception $e){ 
                        $post_engaged_users =  0;
                        $post_impressions_fan_unique =  0;
                    }
                    
                    $whoLikes = [];
                    $likesCount = 0;
                    if(!empty($value['likes'])){
                        $likesCount = count($value['likes']);
                        foreach ($value['likes'] as  $likesData) {
                            array_push($whoLikes,[
                                'id'   => $likesData['id'],
                                'name' => $likesData['name']
                            ]);
                        }
                    }
                   
                    array_push($data, [
                        'id' => $value['id'],
                        'message' => $value['message'] ?? '',
                        'full_picture' => $value['full_picture'] ?? '',
                        'picture' => $value['picture'] ?? '',
                        'date'    => $date,
                        'post_engaged_users' => $post_engaged_users,
                        'post_impressions_fan_unique' => $post_impressions_fan_unique,
                        'comments' => $value['comments'] ? count($value['comments']) : 0,
                        'likes' => $likesCount,
                        'whoLikes' => $whoLikes,
                        'fromName' => $value['from']['name'] ?? '',
                        'fromImage' => $value['from']['picture']['url'] ?? '',
                        'admin_creator' => $value['admin_creator']['name'] ?? ''
                    ]);
                }
            }
            
            if (!file_exists(\config('app.FILE_PATH').'public/facebook/'.$campaignId)) {
                mkdir(\config('app.FILE_PATH').'public/facebook/'.$campaignId, 0777, true);
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }else{
                file_put_contents(\config('app.FILE_PATH').'public/facebook/'.$campaignId.$fileName, json_encode($data));
            }
            return true;
        }catch(\Exception $e){ 
            Error::updateOrCreate(
                ['request_id' => $campaignId,'module'=> 6],
                ['response'=> json_encode($e->getMessage()),'request_id' => $campaignId,'module'=> 6]
            );
            return $e->getMessage();
        }
    }


}