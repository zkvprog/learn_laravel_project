<?php

namespace App\Console;

use App\Console\Commands\ArticlesForPeriod;
use App\Console\Commands\Job\NewResourcesReportJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $start = Carbon::now()->subWeek()->startOfWeek();
        $end = Carbon::now()->subWeek()->endOfWeek();

        $schedule->command(ArticlesForPeriod::class, [
            $start,
            $end,
            '--all'
        ])
            ->mondays()
            ->at('12:00')
        ;

        $schedule->command(NewResourcesReportJob::class, [])
            ->weeklyOn(1, '10:00');;
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
