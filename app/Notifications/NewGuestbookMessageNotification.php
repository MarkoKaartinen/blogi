<?php

namespace App\Notifications;

use App\Models\GuestbookMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewGuestbookMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public GuestbookMessage $message) {}

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
        $guestbookUrl = route('guestbook');

        return (new MailMessage)
            ->subject('Uusi vieraskirjaviesti')
            ->greeting('Uusi vieraskirjaviesti!')
            ->line('Vieraskirjaan on saapunut uusi viesti.')
            ->line('**Lähettäjä:** '.$this->message->nickname)
            ->line('**Viesti:**')
            ->line($this->message->message)
            ->action('Näytä vieraskirja', $guestbookUrl)
            ->action('Hallinnoi viestiä', url('/admin/guestbook/'.$this->message->id.'/edit'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message_id' => $this->message->id,
            'nickname' => $this->message->nickname,
        ];
    }
}
