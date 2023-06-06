<?php

namespace App\Console\Commands\Job;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class NewResourcesReportJob extends Command
{
    protected $signature = 'command:new_resources';

    protected $description = 'Send report about new records in the blog';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        \App\Jobs\NewResourcesForWeekReport::dispatch();
    }
}
