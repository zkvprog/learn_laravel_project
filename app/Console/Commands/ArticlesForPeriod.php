<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use App\Notifications\PeriodArticlesNotification;
use Illuminate\Console\Command;

class ArticlesForPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:articles_for_period
        {start : Дата от}
        {end?  : Дата до}
        {--all : Для всех пользователей}
        {--id=* : Для указанных пользователей}'
    ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All articles for period';

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
        if ($this->option('all')) {
            $users = User::all();
        } elseif ($this->option('id')) {
            $users = User::findOrFail($this->option('id'));
        } else {
            $users = User::where(['role_id' => Role::USER_ROLE_ID])->get();
        }

        $articles = $this->argument('end')
            ? Article::whereBetween('created_at', [$this->argument('start'), $this->argument('end')])->get()
            : Article::whereBetween('created_at', [$this->argument('start'), date('Y-m-d')])->get()
        ;

        $users->map->notify(new PeriodArticlesNotification($articles));
    }
}
