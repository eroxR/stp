<?php

namespace Database\Seeders;

use App\Models\Charge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Charge::insert([
            ['area' => null,'code_charge' => 'MO', 'description_charge' => 'Monitor(a)'],//1
            ['area' => null,'code_charge' => 'P', 'description_charge' => 'Practicante'],//2
            ['area' => null,'code_charge' => 'A', 'description_charge' => 'Auxiliar'],//3
            ['area' => 1,'code_charge' => 'RH', 'description_charge' => 'Coordinador(a) de Recursos Humanos'],//4
            ['area' => 1,'code_charge' => 'RHA', 'description_charge' => 'Auxiliar de Recursos Humanos'],//5
            ['area' => 2,'code_charge' => 'CCS', 'description_charge' => 'Coordinador(a) Compras y Suministros'],//6
            ['area' => 2,'code_charge' => 'CCSA', 'description_charge' => 'Auxiliar de Compras y Suministros'],//7
            ['area' => 4,'code_charge' => 'COP', 'description_charge' => 'Coordinador(a) Operativo'],//8
            ['area' => 4,'code_charge' => 'COPA', 'description_charge' => 'Auxiliar Operativo'],//9
            ['area' => 4,'code_charge' => 'CO', 'description_charge' => 'Conductor(a)'],//10
            ['area' => 1,'code_charge' => 'CSG', 'description_charge' => 'Coordinador(a) de Seguridad y salud en el trabajo'],
            ['area' => 1,'code_charge' => 'CSGA', 'description_charge' => 'Auxiliar de Seguridad y salud en el trabajo'],
            ['area' => 6,'code_charge' => 'GA', 'description_charge' => 'Gerente General'],
            ['area' => 6,'code_charge' => 'GAA', 'description_charge' => 'Auxiliar de Gerencia'],
            ['area' => 7,'code_charge' => 'AU', 'description_charge' => 'Auditor(a) Interno'],
            ['area' => 7,'code_charge' => 'AUA', 'description_charge' => 'Auxiliar de Auditoria'],
            ['area' => 7,'code_charge' => 'AE', 'description_charge' => 'Auditor(a) Externo'],
            ['area' => 8,'code_charge' => 'CI', 'description_charge' => 'Coordinador(a) de Infraestructura'],
            ['area' => 8,'code_charge' => 'CIA', 'description_charge' => 'Auxiliar de Infraestructura'],
            ['area' => 10,'code_charge' => 'CL', 'description_charge' => 'Coordinador(a) de Logistica'],
            ['area' => 10,'code_charge' => 'CLA', 'description_charge' => 'Auxiliar Logistico'],
            ['area' => 9,'code_charge' => 'CCB', 'description_charge' => 'Coordinador(a) de Contabilidad'],
            ['area' => 9,'code_charge' => 'CCBA', 'description_charge' => 'Auxiliar Contable'],
            ['area' => 11,'code_charge' => 'CF', 'description_charge' => 'Coordinador(a) de Facturación'],
            ['area' => 11,'code_charge' => 'CFA', 'description_charge' => 'Auxiliar Facturación'],
            ['area' => 16,'code_charge' => 'CT', 'description_charge' => 'Coordinador(a) de Tesoreria'],
            ['area' => 16,'code_charge' => 'CTA', 'description_charge' => 'Auxiliar Tesoreria'],
            ['area' => 18,'code_charge' => 'CTI', 'description_charge' => 'Coordinador(a) de Tecnologia'],
            ['area' => 18,'code_charge' => 'CTIA', 'description_charge' => 'Auxiliar de Tecnologia'],
            ['area' => 1,'code_charge' => 'CA', 'description_charge' => 'Coordinador(a) de Atencion al Cliente'],
            ['area' => 1,'code_charge' => 'CAA', 'description_charge' => 'Auxiliar Atencion al Clinete'],
            ['area' => 19,'code_charge' => 'CS', 'description_charge' => 'Coordinador(a) de Servicios Generales'],
            ['area' => 19,'code_charge' => 'CSA', 'description_charge' => 'Auxiliar de Servicios Generales'],
            ['area' => 1,'code_charge' => 'VI', 'description_charge' => 'Coordinador(a) de Vinculación'],
            ['area' => 1,'code_charge' => 'VIA', 'description_charge' => 'Auxiliar de Vinculación'],           
            
        ]);
    }
}
