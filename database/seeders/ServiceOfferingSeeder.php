<?php

namespace Database\Seeders;

use App\Models\ServiceOffering;
use Illuminate\Database\Seeder;

class ServiceOfferingSeeder extends Seeder
{
    public function run(): void
    {
        ServiceOffering::factory()->count(100)->create();
    }
}
