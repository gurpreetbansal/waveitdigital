<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SemrushUserAccount;
use App\SiteAuditSummary;
use Illuminate\Http\Request;

use App\Http\Controllers\Vendor\SiteAuditReportsController;

use App\Traits\SiteAuditTrait;

class SiteAudit extends Command
{ 

    use SiteAuditTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SiteAudit:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Site Audit update pages';

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
      
      $domainDetails = SemrushUserAccount::
      whereHas('UserInfo', function($q){
        $q->whereDate('subscription_ends_at', '>=', date('Y-m-d'))
        ->where('subscription_status', 1);
      })
      ->where('status','0')
      ->where(function ($q) {
        $q->doesntHave('auditSummary')
        ->orWhereHas('auditSummary', function($q){
        $q->whereDate('updated_at', '<' ,date('Y-m-d'));
        });
      })
      ->orderBy('id','ASC')
      ->get();

      file_put_contents(dirname(__FILE__).'/logs/audit.txt',print_r($domainDetails,true));

      $request = Request::capture();
      foreach ($domainDetails as $key => $value) {
        
          if($value->auditSummary <> null){
            $request->request->add(['url' => $value->auditSummary->url]);
            $urlList = $this->updateAuditRefresh($request,$value->UserInfo->company_name,$value->auditSummary->id);
          }else{
            $request->request->add(['url' => $value->host_url]);
            $request->request->add(['user_id' => $value->user_id]);
            $request->request->add(['campaign_id' => $value->id]);
            $this->siteAuditRun($request);
          }

          die;
        
      }
      
        
    }



  }
