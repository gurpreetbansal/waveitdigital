<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\CampaignSetting;
use App\Views\ViewKeywordSearch;
use Mail;

class KeywordAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Keyword:Alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule email to send daily for the ranked keywords';

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
        $data = CampaignSetting::
        whereHas('UserInfo', function($q){
            $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
            ->where('subscription_status', 1);
        })
        ->withCount([
            'SemrushUserData' => function($query) {
                $query->select('id','domain_name','host_url','keyword_alerts_email','clientName');
            }
        ])
        ->where('keyword_alerts_date',date('Y-m-d'))
        ->get();
        
        if(isset($data) && !empty($data)){
            foreach($data as $key=>$value){
                $user_id = $value->user_id;
                $viewkey_link = \config('app.base_url').'project-detail/'.base64_encode($value->request_id.'-|-'.$value->user_id.'-|-'.time());
                $previous_date = date('F d',strtotime('-1 day',strtotime(now())));
                $today = date('F d',strtotime(now()));

                $result = ViewKeywordSearch::
                select('keyword','request_id','oneday_position','sv','position','region')
                ->where('oneday_position','!=',0)
                ->where('request_id',$value->request_id)
                ->whereHas('SemrushUserData', function($q) use ($user_id){
                    $q->where('status', 0)
                    ->where('user_id',$user_id);
                })
                ->orderBy('oneday_position','asc')
                ->whereDate('updated_at',date('Y-m-d'))
                ->get();

                if(count($result) > 0){
                    $email = $value->SemrushUserData->keyword_alerts_email;
                    $data_array = array('value'=>$value,'result'=>$result,'viewkey_link'=>$viewkey_link,'previous_date'=>$previous_date,'today'=>$today);
                    try{
                        Mail::send(['html' => 'mails/vendor/keyword_alerts'], $data_array, function($message) use ($email,$value)
                        {    
                            $message->to($email)
                            ->subject('Notification of rank change. Project: '.$value->SemrushUserData->domain_name)
                            ->from(\config('app.mail'), 'Agency Dashboard');   
                        });
                    }catch(\Exception $exception){
                        // return $exception->getMessage();
                    }


                    if (!Mail::failures()){           
                        CampaignSetting::where('id',$value->id)->update([
                            'keyword_alerts_date' => date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))))
                        ]); 
                    }
                }
            }   
        }

    }
}
