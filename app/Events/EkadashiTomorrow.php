<?php

namespace App\Events;

use App\Models\Ekadashi;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EkadashiTomorrow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Ekadashi $ekadashi;

    /**
     * Create a new event instance.
     */
    public function __construct(Ekadashi $ekadashi)
    {
        $this->ekadashi = $ekadashi;
    }
}
