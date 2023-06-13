<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use App\Models\Ekadashi;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EkadashiNotification extends Notification
{
    use Queueable;

    private Ekadashi $ekadashi;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ekadashi $ekadashi)
    {
        $this->ekadashi = $ekadashi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ekadashi Reminder')
            ->markdown('ekadashi.reminder', [
                'name' => $this->ekadashi->name,
                'url' => $this->ekadashi->url,
            ]);
    }

    public function toWhatsApp($notifiable)
    {
        return (new WhatsAppMessage)
            ->content("Tomorrow is " . $this->ekadashi->name . " Ekadashi! Read the story here: " . url($this->ekadashi->url));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
