<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\WorkingHours;
use Illuminate\Database\Seeder;

class WorkingHoursSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        $dayOfWeeks = ['Ponedeljak', 'Utorak', 'Srijeda', 'Cetvrtak', 'Petak', 'Subota', 'Nedelja'];

        Service::all()->each(function ($service) use ($dayOfWeeks) {
           foreach ($dayOfWeeks as $day) {
               WorkingHours::create([
                   'service_id' => $service->id,
                   'day_of_week' => $day,
                   'opens_at' => mt_rand(6,8),
                   'closes_at' => mt_rand(14,16)
               ]);
           }
        });
    }
}

