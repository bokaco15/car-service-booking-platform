<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            ServiceOfferingSeeder::class,
            WorkingHoursSeeder::class,
        ]);
    }
}
