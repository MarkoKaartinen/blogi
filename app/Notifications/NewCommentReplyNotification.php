<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Comment $reply, public Comment $parentComment) {}

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
        $article = $this->parentComment->article;

        return (new MailMessage)
            ->subject('Uusi vastaus kommenttiisi: '.$article->title)
            ->greeting('Hei '.$this->parentComment->nickname.'!')
            ->line('Kommenttiisi artikkelissa "'.$article->title.'" on vastattu.')
            ->line('**Vastaaja:** '.$this->reply->nickname)
            ->line('**Vastaus:**')
            ->line($this->reply->comment)
            ->action('Näytä vastaus', $article->url.'#comment-'.$this->parentComment->id);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reply_id' => $this->reply->id,
            'parent_comment_id' => $this->parentComment->id,
            'article_id' => $this->parentComment->article_id,
        ];
    }
}
