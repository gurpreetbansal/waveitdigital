<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SemrushUserAccount;
use App\GoogleAnalyticsUsers;
use App\AdwordsCampaignDetail;
use App\AdwordsKeywordDetail;
use App\AdwordsAdTextDetail;
use App\AdwordsAdGroupDetail;
use App\AdwordsPlaceHolderDetail;
use App\GoogleUpdate;

use App\Traits\GoogleAdsTrait;



class GoogleAdwords extends Command
{

    use GoogleAdsTrait; 

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Google:Adwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Google adwords csv data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client_id = \config('app.ads_client_id');
        $this->client_secret = \config('app.ads_client_secret');
        $this->developerToken = \config('app.ads_developerToken');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $semrush_data = SemrushUserAccount::
        whereHas('UserInfo', function($q){
            $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
            ->where('subscription_status', 1);
        })  
        ->with(array('google_adwords_account'=>function($query){
            $query->select('id','customer_id');
        }))
        ->where('status','0')
        ->whereNotNull('google_ads_id')
        ->whereNotNull('google_ads_campaign_id')

        /*->where(function($q){
            $q->whereRaw("exists (select * from `google_updates` where `semrush_users_account`.`id` = `google_updates`.`request_id` and (DATE(`adwords`) <> '".date('Y-m-d')."' or adwords IS NULL))  or not exists (select * from `google_updates` where `semrush_users_account`.`id` = `google_updates`.`request_id`)");
        })
        ->whereDoesntHave('GoogleErrors', function ($q) {
            $q->where('module',3)
            ->whereDate('updated_at',date('Y-m-d'));
        })*/
        ->get();

        file_put_contents(dirname(__FILE__).'/logs/googles.txt',print_r($semrush_data,true));
        if(!empty($semrush_data) && isset($semrush_data)){
            foreach($semrush_data as $key=>$value){
                if($value->status == 0  && $value->google_ads_id <> null && $value->google_ads_campaign_id <> null){
                    $data = $this->cronGoogleAdlogs($value->id);
                    /*if($data['status'] == 'success'){
                        $response['status'] = 'success';
                        $response['account_id'] = $value->google_ads_id;
                    }else{
                        $data['account_id'] = $value->google_ads_id;
                        $response = $data;
                    }*/
                }
            }
        }
    }
}