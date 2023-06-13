<?php

namespace App\Console\Commands;

use App\Events\EkadashiTomorrow;
use App\Models\Ekadashi;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendar:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a personal reminder for the next Ekadashi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Ekadashi::tomorrow()) {
            EkadashiTomorrow::dispatch(Ekadashi::tomorrow());
            $this->info('The reminder was sent!');
        } else {
            $this->info("Tomorrow isn't Ekadashi");
        }
    }
}
