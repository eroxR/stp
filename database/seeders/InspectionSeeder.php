<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inspection::insert([
            ['name_description' => 'LINTERNA', 'category_id' => 1],
            ['name_description' => 'BOTIQUIN', 'category_id' => 1],
            ['name_description' => 'EXTINTOR CARGADO', 'category_id' => 1],
            ['name_description' => 'HERRAMIENTA BASICA', 'category_id' => 1],
            ['name_description' => 'CRUCETA', 'category_id' => 1],
            ['name_description' => 'GATO', 'category_id' => 1],
            ['name_description' => 'CHALECO REFLECTIVO', 'category_id' => 1],
            ['name_description' => 'CONOS', 'category_id' => 1],
            ['name_description' => 'LLANTA REPUESTO', 'category_id' => 1],
            ['name_description' => 'ACEITE MOTOR', 'category_id' => 2],
            ['name_description' => 'FRENOS', 'category_id' => 2],
            ['name_description' => 'LIMPIA PARABRISAS', 'category_id' => 2],
            ['name_description' => 'REFRIGERANTE', 'category_id' => 2],
            ['name_description' => 'COMBUSTIBLE', 'category_id' => 2],
            ['name_description' => 'HIDRAULICO', 'category_id' => 2],
            ['name_description' => 'ALTAS', 'category_id' => 3],
            ['name_description' => 'BAJAS', 'category_id' => 3],
            ['name_description' => 'DIRECCIONALES DERECHA', 'category_id' => 3],
            ['name_description' => 'DIRECCIONALES IZQUIERDA', 'category_id' => 3],
            ['name_description' => 'STOP', 'category_id' => 3],
            ['name_description' => 'REVERSA', 'category_id' => 3],
            ['name_description' => 'PARQUEO', 'category_id' => 3],
            ['name_description' => 'ANTINIEBLA', 'category_id' => 3],
            ['name_description' => 'PITO', 'category_id' => 4],
            ['name_description' => 'FRENO MANO', 'category_id' => 4],
            ['name_description' => 'CORREA VENTILADOR', 'category_id' => 4],
            ['name_description' => 'CINTURON CONDUCTOR', 'category_id' => 4],
            ['name_description' => 'CINTURON PASAJEROS', 'category_id' => 4],
            ['name_description' => 'ESPEJO LATERAL IZQUIERDO', 'category_id' => 4],
            ['name_description' => 'ESPEJO LATERAL DERECHO', 'category_id' => 4],
            ['name_description' => 'RETROVISOR', 'category_id' => 4],
            ['name_description' => 'LLANTAS DELANTERAS', 'category_id' => 4],
            ['name_description' => 'LLANTAS TRASERAS', 'category_id' => 4],
            ['name_description' => 'ALINEACION', 'category_id' => 4],
            ['name_description' => 'BALANCEO', 'category_id' => 4],
            ['name_description' => 'SINCRONIZACION', 'category_id' => 4],
            ['name_description' => 'ASEO INTERNO', 'category_id' => 4],
            ['name_description' => 'ASEO EXTERNO', 'category_id' => 4],
            ['name_description' => 'COJINERIA', 'category_id' => 4],
            ['name_description' => 'MANILLAS PUERTAS', 'category_id' => 4],
            ['name_description' => 'CHAPAS PUERTAS', 'category_id' => 4],
            ['name_description' => 'TABLERO CONTROLES', 'category_id' => 4],
            ['name_description' => 'AIRE ACONDICIONADO', 'category_id' => 4],
        ]);
    }
}
