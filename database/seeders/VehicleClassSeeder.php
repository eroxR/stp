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
            ['vehicle_class_description' => 'Gasolina'],
            ['vehicle_class_description' => 'Diesel'],
            ['vehicle_class_description' => 'Gas Natural Vehicular (GNV)'],
            ['vehicle_class_description' => 'Gasolina-Gas'],
            ['vehicle_class_description' => 'Eléctrico'],
            ['vehicle_class_description' => 'Hidrógeno'],
            ['vehicle_class_description' => 'Etanol'],
            ['vehicle_class_description' => 'Biodiesel'],
        ]);
    }
}
