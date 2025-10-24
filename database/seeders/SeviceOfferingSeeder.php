<?php

namespace Database\Seeders;

use App\Models\ServiceOffering;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeviceOfferingSeeder extends Seeder
{
    public function run(): void
    {
        ServiceOffering::factory()->count(100)->create();
    }
}
