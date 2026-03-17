<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleType::insert([
            ['vehicle_type_name' => 'Automóvil'],
            ['vehicle_type_name' => 'Buggy'],
            ['vehicle_type_name' => 'Bus'],
            ['vehicle_type_name' => 'Buseta'],
            ['vehicle_type_name' => 'Camión'],
            ['vehicle_type_name' => 'Camioneta'],
            ['vehicle_type_name' => 'Campero'],
            ['vehicle_type_name' => 'Convertible'],
            ['vehicle_type_name' => 'Coupe'],
            ['vehicle_type_name' => 'Cuatrimoto'],
            ['vehicle_type_name' => 'Hatchback'],
            ['vehicle_type_name' => 'Limusina'],
            ['vehicle_type_name' => 'Microbús'],
            ['vehicle_type_name' => 'Motocarro'],
            ['vehicle_type_name' => 'Motocicleta'],
            ['vehicle_type_name' => 'Mototriciclo'],
            ['vehicle_type_name' => 'Panel'],
            ['vehicle_type_name' => 'Picó'],
            ['vehicle_type_name' => 'Sedán'],
            ['vehicle_type_name' => 'Tractocamión'],
            ['vehicle_type_name' => 'Van'],
            ['vehicle_type_name' => 'Volqueta'],
        ]);
    }
}
