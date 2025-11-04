<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingHours>
 */
class WorkingHoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dayOfWeeks = ['Poenedeljak', 'Utorak', 'Srijeda', 'Cetvrtak', 'Petak', 'Subota', 'Nedelja'];

       return [
           'service_id' => Service::inRandomOrder()->first()->id,
           'day_of_week' => fake()->randomElement($dayOfWeeks),
           'opens_at' => mt_rand(1,10),
           'closes_at' => mt_rand(14,18),
       ];
    }
}
