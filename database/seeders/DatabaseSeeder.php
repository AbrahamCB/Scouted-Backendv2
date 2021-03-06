<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // CountrySeeder::class,
            // StateSeeder::class,
            // CitySeeder::class,
            // TimezoneSeeder::class,
            TagSeeder::class
        ]);
    }
}
