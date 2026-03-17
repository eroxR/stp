<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleInspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleInspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        VehicleInspection::factory()->count(105)->create();
    }
}
