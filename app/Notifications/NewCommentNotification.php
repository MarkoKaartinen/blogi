<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Comment $comment) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $article = $this->comment->article;

        return (new MailMessage)
            ->subject('Uusi kommentti: '.$article->title)
            ->greeting('Uusi kommentti!')
            ->line('Artikkeliin "'.$article->title.'" on saapunut uusi kommentti.')
            ->line('**Kommentoija:** '.$this->comment->nickname)
            ->line('**Sähköposti:** '.$this->comment->email)
            ->line('**Kommentti:**')
            ->line($this->comment->comment)
            ->action('Näytä artikkeli', $article->url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'article_id' => $this->comment->article_id,
            'nickname' => $this->comment->nickname,
        ];
    }
}
