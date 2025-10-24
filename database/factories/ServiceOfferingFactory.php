<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOffering>
 */
class ServiceOfferingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'service_id' => Service::inRandomOrder()->first()->id,
            'name' => fake()->sentence(2),
            'duration_minutes' => mt_rand(30, 120),
            'price' => mt_rand(50,1000),
        ];
    }
}
