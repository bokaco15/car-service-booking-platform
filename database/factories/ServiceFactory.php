<?php

namespace Database\Factories;

use App\Enums\ServiceStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'city' => fake()->city(),
            'description' => fake()->text(30),
            'status' => fake()->randomElement(ServiceStatus::cases()),
        ];
    }
}
