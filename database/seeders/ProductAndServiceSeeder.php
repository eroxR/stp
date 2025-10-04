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
            ['ProductandService_description' => 'Asesorias Juridicas'],
            ['ProductandService_description' => 'Asesorias SGSST'],   
            ['ProductandService_description' => 'Asesorias Técnicas'],          
            ['ProductandService_description' => 'Combustible'],               
            ['ProductandService_description' => 'Contabilidad'],                
            ['ProductandService_description' => 'Convenios Empresariales'],          
            ['ProductandService_description' => 'Examenes Medicos de Ingresos y Retiros'],                 
            ['ProductandService_description' => 'Repuestos'],         
            ['ProductandService_description' => 'Revisiones Tecnomecanicas'],            
            ['ProductandService_description' => 'Revisorias Fiscales'],               
            ['ProductandService_description' => 'Software y Comunicaciones'],
        ]);
    }
}
