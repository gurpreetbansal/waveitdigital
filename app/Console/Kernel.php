<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\LiveKeywordTracking::class,
        Commands\googleSearchConsole::class,
        Commands\GoogleAnalytics::class,
        Commands\DFSApiBalance::class,
        Commands\MozData::class,
        Commands\BackLinks::class,
        Commands\GoogleAdwords::class,
        Commands\DFSExtraOrganicKeywords::class,
        Commands\GoogleMyBusiness::class,
        Commands\ScheduleReportNow::class,
        Commands\DailyKeywordAlerts::class,
        Commands\KeywordExplorerDeletion::class,
        Commands\StripeLinkExpiration::class,
        Commands\SendStripeInvoice::class,
        Commands\StripeSendReminder::class,
        Commands\StripeCheckInvoiceStatus::class,
        Commands\GoogleAnalytics4::class,
        Commands\FacebookRefresh::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {        
        // $schedule->command('Live:keyword')
        //     ->everyMinute();
 
        // $schedule->command('Search:Console')
        //     ->twiceDaily(2,19);

        // $schedule->command('Google:Analytics')
        //    ->everyThirtyMinutes();

        // $schedule->command('DFS:Balance')
        //     ->hourly();

        // $schedule->command('Moz:Store')
        // ->everyMinute(); 

        // $schedule->command('BackLinks:serpstat')
        // ->daily();

        // $schedule->command('Google:Adwords')
        // ->dailyAt('07:54');
        // ->twiceDaily(11,21);

        // $schedule->command('DFS:ExtraOrganicKeywords')
        // ->dailyAt('08:08');

          // $schedule->command('Google:MyBusiness')
          // ->daily();

        // $schedule->command('ScheduleReport:Now')
        //   ->everyMinute();

        $schedule->command('ScheduledReport:SpecificDate')
          ->dailyAt('01:00');

         // $schedule->command('Keyword:Alert')
         //  ->everyMinute();

         // $schedule->command('KeywordExplorer:Deletion')
         //  ->daily(); 

        // $schedule->command('Stripe:LinkExpiration')
        // ->daily();

        // $schedule->command('Stripe:SendInvoice')
        // ->dailyAt('11:43');
        // ->daily();
        // ->everyMinute();
        
        // $schedule->command('Stripe:SendReminder')
        // ->daily(); 


        // $schedule->command('Stripe:CheckInvoiceStatus')
        // ->everyMinute();

        $schedule->command('SiteAudit:refresh')
        ->dailyAt('13:24');

        // $schedule->command('Google:Analytics4')
        // ->dailyAt('09:00');

        $schedule->command('Facebook:Refresh')
          ->dailyAt('04:48');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
