<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\KeywordPosition;
use App\KeywordSearch;
use App\Traits\ClientAuth;
use App\SemrushUserAccount;
use App\ActivityLog;


class LiveKeywordTracking extends Command
{

    use ClientAuth;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Live:keyword';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tracking keywords';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //      $keyword_position = KeywordPosition::
        // whereHas('campaign_data', function ($query) {
        //     $query->where('status', 0);
        // })
        // ->where('status','!=','1')
        // ->whereDate('created_at','<',date('Y-m-d'))
        // ->groupBy('keyword_id')
        // ->orderBy('created_at','desc')
        // ->limit(100)
        // ->get();



        $keyword_position = KeywordPosition::
        whereHas('campaign_data', function ($query) {
            $query->where('status', 0);
            $query->whereHas('UserInfo', function($q){
                $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
                ->where('subscription_status', 1);
            });
        }) 
        ->where('status','!=','1')
        ->whereDate('created_at','<',date('Y-m-d'))
        ->groupBy('keyword_id')
        ->orderBy('created_at','desc')
        ->limit(100)
        ->get();

         // file_put_contents(dirname(__FILE__).'/livekeyword.txt',print_r($keyword_position,true));
         //   die;

        
        $client = null;
        try {
          $client = $this->DFSAuth();
          
        } catch (RestClientException $e) {
            return json_decode($e->getMessage(), true);
        }
        

        if(!empty($keyword_position)){
            foreach($keyword_position as $result){
                
                $search_data = KeywordSearch::where('id',$result->keyword_id)->first();
                $semrush = SemrushUserAccount::where('id',$result->request_id)->first();
                $user_id = $semrush->user_id;

                if(empty($search_data)){
                    continue;
                }   
               // file_put_contents(dirname(__FILE__).'/keywordlog.txt',print_r(url('/'),true));

                   
                 
                $post_array  =array();
                $post_array[] = array(
                        "language_name" => $search_data->language,
                        // "location_name" => $search_data->canonical,
                        'location_coordinate'=>$search_data->lat.','.$search_data->long,
                        "se_domain" => $search_data->region,
                        "domain" => $search_data->host_url,
                        "keyword" => mb_convert_encoding($search_data->keyword, "UTF-8"),
                        "priority" => 2,
                        "postback_data" => "advanced",
                        "postback_url" => url('/cron_postbackAddKeyResponse?request_id='.$result->request_id.'&keyword_id='.$result->keyword_id.'&data_id='.$result->id.'&user_id='.$user_id)
                );

                
                KeywordPosition::where('id',$result->id)->update([
                    'status'=> '1'
                ]);     


                try {
                    $resultOrg = $client->post('/v3/serp/google/organic/task_post', $post_array);
                     
                    $post_array = array();
                    $response['status'] = '1'; 
                    $response['error'] = '0';
                    $response['message'] = 'Keyword Added Successfully';
                    $response['html']   =   '';
                } catch (RestClientException $e) {
                    $response['status'] = '2'; 
                    $response['error'] = '2';
                    $response['message'] = $e->getMessage();
                }
                
            }           
        }
    }


    public static function DFSAuth(){
     $base_uri = config('app.DFS_URI');
     $user = config('app.DFS_USER');
     $pass = config('app.DFS_PASS');
     $client = new \RestClient($base_uri, null, $user, $pass);
     return $client;
  }

}