<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewResourcesForWeekReportNotification extends Notification
{
    use Queueable;

    protected $articlesCount;
    protected $articlesCommentCount;
    protected $newsCount;
    protected $newsCommentCount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($articlesCount, $articlesCommentCount, $newsCount, $newsCommentCount)
    {
        $this->articlesCount = $articlesCount;
        $this->articlesCommentCount = $articlesCommentCount;
        $this->newsCount = $newsCount;
        $this->newsCommentCount = $newsCommentCount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('mail.new-weekly-resources-report', [
                        'articlesCount' => $this->articlesCount,
                        'articlesCommentCount' => $this->articlesCommentCount,
                        'newsCount' => $this->newsCount,
                        'newsCommentCount' => $this->newsCommentCount,
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
