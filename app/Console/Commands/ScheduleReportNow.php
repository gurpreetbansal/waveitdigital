<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendScheduleReport;
use App\ScheduleReport;
use App\ScheduleReportHistory;
use Mail;

class ScheduleReportNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ScheduleReport:Now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for report for send now';

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
        $results = SendScheduleReport::get();
        if(isset($results) && !empty($results)){
            foreach($results as $key=>$value){
                $filename = $value->file_name;
                $file_path = \config('app.FILE_PATH').'public/report_downloads/'.$filename;
                if (file_exists($file_path)) {
                    $report = ScheduleReport::where('id',$value->report_id)->first();
                    $email = explode(', ',$report->email);
                    $emails = array_map('trim', $email);
                    $data = array('email_text'=>$report->mail_text);

                    $system_setting  = UserSystemSetting::where('user_id',$value->user_id)->first();

                    if(!empty($system_setting)){
                       $email_from = $system_setting->email_deliver_from;
                       $reply_to = $system_setting->email_reply_to;
                    }else{
                       $email_from = $reply_to = \config('app.mail');
                    }

                    try{
                        Mail::send(['html' => 'mails/vendor/schedule_reports'], $data, function($message) use ($emails,$report,$file_path,$filename,$email_from,$reply_to)
                        {    
                            $message->to($emails)
                            ->subject($report->subject.' '.$report->project_name->domain_name)
                            ->attach($file_path, [
                                'as' => $filename, 
                                'mime' => 'application/pdf'
                            ])
                            ->replyTo($reply_to);
                            $message->from($email_from, 'Agency Dashboard');   
                        });


                    }catch(\Exception $exception){
                        // return $exception->getMessage();
                    }

                    if (Mail::failures()){           
                    }else{
                        SendScheduleReport::where('id',$value->id)->delete();
                        if($file_path){
                            unlink($file_path);
                        
                            ScheduleReport::where('id',$value->report_id)->update([
                                'last_delivery' => now(),
                                'next_delivery' => ScheduleReport::calculateDate($report,2)
                            ]);

                            foreach($emails as $email){
                                ScheduleReportHistory::create([
                                    'report_id' => $value->report_id,
                                    'email' => $email,
                                    'sent_on'=> date('Y-m-d')
                                ]);
                            }   
                        }                     
                    }
                }
            }
        }
    }
}
