<?php

namespace App\Listeners;

use App\Events\{EkadashiTomorrow};
use App\Models\User;
use App\Notifications\EkadashiNotification;
use Illuminate\Support\Facades\Notification;

class SendEkadashiReminder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EkadashiTomorrow $event): void
    {
        Notification::send(User::find(1), new EkadashiNotification($event->ekadashi));
    }
}
