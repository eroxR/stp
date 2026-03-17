<?php

namespace Database\Seeders;

use App\Models\productAndService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAndServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        productAndService::insert([
            ['productandservice_description' => 'Asesorias Juridicas'],
            ['productandservice_description' => 'Asesorias SGSST'],
            ['productandservice_description' => 'Asesorias Técnicas'],
            ['productandservice_description' => 'Combustible'],
            ['productandservice_description' => 'Contabilidad'],
            ['productandservice_description' => 'Convenios Empresariales'],
            ['productandservice_description' => 'Examenes Medicos de Ingresos y Retiros'],
            ['productandservice_description' => 'Repuestos'],
            ['productandservice_description' => 'Revisiones Tecnomecanicas'],
            ['productandservice_description' => 'Revisorias Fiscales'],
            ['productandservice_description' => 'Software y Comunicaciones'],
        ]);
    }
}
