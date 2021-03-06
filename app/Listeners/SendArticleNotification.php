<?php

namespace App\Listeners;

use App\Events\ArticleChanged;
use App\Services\PushAll\PushAllBroadcast;
use App\Notifications\ArticleNotification;
use Illuminate\Support\Facades\Notification;

class SendArticleNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleChanged $event)
    {
        Notification::route('mail', config('mail.admin_email_address'))->notify(new ArticleNotification($event->article, $event->event));

        if ($event->article->published) {
            app(PushAllBroadcast::class)->send('Создана новая статья', $event->article->title);
        }
    }
}
