<?php

namespace App\Providers;

use App\Providers\EkadashiTomorrow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
