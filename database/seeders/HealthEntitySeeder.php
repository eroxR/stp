<?php

namespace Database\Seeders;

use App\Models\HealthEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthEntity::insert([
            ['description_eps' => 'ALIANSALUD'],
            ['description_eps' => 'AMBUQ'],
            ['description_eps' => 'ASMET SALUD'],
            ['description_eps' => 'CAFE SALUD'],
            ['description_eps' => 'CAPITAL SALUD'],
            ['description_eps' => 'COMPARTA'],
            ['description_eps' => 'COMPENSAR'],
            ['description_eps' => 'COOMEVA'],
            ['description_eps' => 'COOSALUD'],
            ['description_eps' => 'CRUZ BLANCA'],
            ['description_eps' => 'EMSSANAR'],
            ['description_eps' => 'FAMISANAR'],
            ['description_eps' => 'MEDIMAS'],
            ['description_eps' => 'MUTUAL SER'],
            ['description_eps' => 'NUEVA EPS'],
            ['description_eps' => 'SALUD TOTAL'],
            ['description_eps' => 'SALUDVIDA'],
            ['description_eps' => 'SANITAS'],
            ['description_eps' => 'SAVIA SALUD'],
            ['description_eps' => 'SERVICIO OCCIDENTAL DE SALUD S.O.S'],
            ['description_eps' => 'SURA'],
        ]);
    }
}
