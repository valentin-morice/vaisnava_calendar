<?php

namespace Database\Seeders;

use App\Models\Ekadashi;
use Illuminate\Database\Seeder;

class EkadashiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ekadashi::create([
            'name' => 'Apara',
            'date' => '2023-05-16',
            'url' => 'https://iskcondesiretree.com/page/apara-ekadasi'
        ]);

        Ekadashi::factory(9)->create();
    }
}
