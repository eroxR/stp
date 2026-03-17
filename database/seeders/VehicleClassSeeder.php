<?php

namespace Database\Seeders;

use App\Models\VehicleClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleClass::insert([
            ['vehicle_class_description' => 'Transmisión manual'],
            ['vehicle_class_description' => 'Transmisión automática'],
            ['vehicle_class_description' => 'Transmisión semiautomática'],
            ['vehicle_class_description' => 'Eléctrico'],
        ]);
    }
}
