<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NewResourcesForWeekReportNotification;
use App\Notifications\PeriodArticlesNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewResourcesForWeekReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start = Carbon::now()->subWeek()->startOfWeek();
        $end = Carbon::now()->subWeek()->endOfWeek();

        $articlesCount = Article::whereBetween('created_at', [$start, $end])
                            ->published(1)->count();

        $articlesCommentCount = Comment::whereMorphRelation('commentable', Article::class, function($q) use ($start, $end) {
            $q->whereBetween('created_at',[$start, $end])->published(1);
        })->count();

        $newsCount = News::whereBetween('created_at', [$start, $end])
                        ->published(1)->count();

        $newsCommentCount = Comment::whereMorphRelation('commentable', News::class, function($q) use ($start, $end) {
            $q->whereBetween('created_at',[$start, $end])->published(1);
        })->count();

        $admins = User::admins()->get();
        $admins->map->notify(new NewResourcesForWeekReportNotification($articlesCount, $articlesCommentCount, $newsCount, $newsCommentCount));
    }
}
