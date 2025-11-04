<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Service;
use App\Models\ServiceOffering;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $service = Service::inRandomOrder()->first()->id;
        $offering = ServiceOffering::where('service_id', $service)->first() ?? ServiceOffering::factory()->create([
            'service_id' => $service
        ]);

        return [
            'service_id' => $service,
            'client_id' => User::inRandomOrder()->first()->id,
            'service_offering_id' => $offering,
            'start_at' => '16:00:00',
            'end_at' => '18:00:00',
            'status' => $this->faker->randomElement(BookingStatus::cases()),
        ];
    }


}
