<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Valentin Morice',
            'email' => 'valentinmorice1@gmail.com',
            'phone_number' => "+33661281101",
        ]);

        User::factory(4)->create();
    }
}
