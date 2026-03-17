<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        FuelType::insert([
            ['fuel_types_description' => 'Gasolina'],
            ['fuel_types_description' => 'Diesel'],
            ['fuel_types_description' => 'Gas Natural Vehicular (GNV)'],
            ['fuel_types_description' => 'Gasolina-Gas'],
            ['fuel_types_description' => 'Carga Eléctrico'],
            ['fuel_types_description' => 'Carga Hidrógeno'],
            ['fuel_types_description' => 'Etanol'],
            ['fuel_types_description' => 'Biodiesel'],
        ]);
    }
}
