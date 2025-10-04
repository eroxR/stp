<?php

namespace Database\Seeders;

use App\Models\Identification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identification::insert([
            ['description_identification' => 'Cedula de Ciudadania'],
            ['description_identification' => 'Cedula de Extranjeria'],
            ['description_identification' => 'Documento Definido para información Exógena'],
            ['description_identification' => 'Nit'],
            ['description_identification' => 'Pasaporte'],
            ['description_identification' => 'Registro Civil'],
            ['description_identification' => 'Tarjeta de Extranjeria'],
            ['description_identification' => 'Tarjeta de Identidad'],
            ['description_identification' => 'Tipo de Documento Extranjero'],
        ]);
    }
}
