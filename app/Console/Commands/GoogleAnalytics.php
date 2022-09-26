<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use App\SemrushUserAccount;
use App\User;
use App\GoogleAnalyticsUsers;
use App\ActivityLog;
use App\ModuleByDateRange;
use App\ProjectCompareGraph;
use App\GoogleUpdate;
use App\Error;
use Auth;
use Exception;

use App\Http\Controllers\Vendor\Test\AnalyticsController;

class GoogleAnalytics extends Command
{
/**
* The name and signature of the console command.
*
* @var string
*/
protected $signature = 'Google:Analytics';

/**
* The console command description.
*
* @var string
*/
protected $description = 'Store analytics data for particular campaign.';

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
  public function handle(){
    AnalyticsController::check_analytics_cron();
  }

}