<?php

namespace App\Console\Commands;

use App\Models\Path;
use Illuminate\Console\Command;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ScrapePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape cities & URI from the Vaisnava Calendar website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', 'http://www.vaisnavacalendar.com/');
        $crawler->filter("#t01 tr td:nth-child(2) form select")->each(function ($node) {
            $string = $node->html();
            $a = explode('</option>', $string);
            $b = array_filter($a, function ($value) {
                return str_contains($value, "value");
            });
            $paths = array_map(function ($value) {
                $a = strstr($value, '"');
                return strstr(substr($a, 1), '"', true);
            }, $b);
            $cities = array_map(function ($value) {
                return trim(substr(strstr($value, '>'), 1));
            }, $b);

            $this->newLine();
            $bar = $this->output->createProgressBar(count($b));
            $bar->start();
            foreach ($b as $key => $value) {
                Path::firstOrCreate([
                    'url' => $paths[$key] . "2023/01"
                ], [
                    'city' => $cities[$key]
                ]);
                $bar->advance();
            }
            $bar->finish();

            $this->newLine();
            $this->newLine();
            $this->line(" The <options=bold;fg=White;bg=red>PATHS</> table has been populated successfully.");
            $this->newLine();
        });
    }
}
