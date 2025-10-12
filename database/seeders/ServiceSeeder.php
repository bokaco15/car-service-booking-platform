<?php

namespace Database\Seeders;

use App\Models\Service;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('sr_Latn_RS');

        for($i = 0 ; $i < 50; $i++) {
            Service::create([
                'user_id' => $faker->numberBetween(1, 50),
                'name' => $faker->company(),
                'city' => $faker->city(),
                'description' => $faker->paragraph(),
                'status'=>$faker->randomElement(['pending', 'approved'])
            ]);
        }
    }
}
