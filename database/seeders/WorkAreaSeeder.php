<?php

namespace Database\Seeders;

use App\Models\WorkArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkArea::insert([
            ['workarea_description' => 'Area de RH'],                   //1
            ['workarea_description' => 'Area Compras y Suministros'],   //2
            ['workarea_description' => 'Area de Vinculación'],          //3
            ['workarea_description' => 'Area Operativa'],               //4
            ['workarea_description' => 'Area Locativa'],                //5
            ['workarea_description' => 'Area Administrativa'],          //6
            ['workarea_description' => 'Area Calidad'],                 //7
            ['workarea_description' => 'Area Infraestructura'],         //8
            ['workarea_description' => 'Area Contabilidad'],            //9
            ['workarea_description' => 'Area Logística'],               //10
            ['workarea_description' => 'Area Financiera'],              //11
            ['workarea_description' => 'Area Comercial'],               //12
            ['workarea_description' => 'Area Legal'],                   //13
            ['workarea_description' => 'Area Facturación'],             //14
            ['workarea_description' => 'Area de Cartera'],              //15
            ['workarea_description' => 'Area de Tesoreria'],            //16
            ['workarea_description' => 'Area de Seguridad'],            //17
            ['workarea_description' => 'Area de Tecnologia'],           //18
            ['workarea_description' => 'Area de Servicios Generales'],  //19

        ]);
    }
}
