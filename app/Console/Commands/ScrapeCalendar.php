<?php

namespace App\Console\Commands;

use App\Models\Path;
use Illuminate\Console\Command;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ScrapeCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape calendar data from the Vaisnava Calendar website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $b = array_map(function ($value) {
            return ' ' . $value . ' ';
        }, range(1, 31));

        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', 'http://www.vaisnavacalendar.com/' . Path::find(1)->url);
        $days = [
            "Pratipat",
            "Dvitiya",
            "Tritiya",
            "Caturthi",
            "Pancami",
            "Sasti",
            "Saptami",
            "Astami",
            "Dasami",
        ];

        $a = $crawler->filter("body center center table")->each(function ($node) {
            $c = [];
            $c[] = $node->text();
            return $c;
        });

        array_shift($a);
        array_splice($a, count($a) - 5, 5);

        $c = array_values(array_filter(array_map(function ($value) {
            return $value[0];
        }, $a)));

        $d = [];
        foreach ($c as $key => $value) {
            $a = str_replace($days, '', $value);
            $d[$key + 1] = trim(str_replace(' ' . $key + 1, '', $a));
        }

        dd($d);
    }
}
