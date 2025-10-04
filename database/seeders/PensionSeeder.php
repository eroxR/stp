<?php

namespace Database\Seeders;

use App\Models\Pension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pension::insert([
            ['description_pension' => 'Askandia S.A.'],
            ['description_pension' => 'Cesantías de Colombia S.A.'],
            ['description_pension' => 'Colfondos'],
            ['description_pension' => 'Colmena'],
            ['description_pension' => 'Colpatria'],
            ['description_pension' => 'Colpensiones'],
            ['description_pension' => 'Davivir S.A.'],
            ['description_pension' => 'Dinners S.A.'],
            ['description_pension' => 'Fondo Nacional del Ahorro'],
            ['description_pension' => 'Granfondo S.A.'],
            ['description_pension' => 'Invermañana'],
            ['description_pension' => 'Invertir'],
            ['description_pension' => 'Old Mutual'],
            ['description_pension' => 'Porvenir S.A.'],
            ['description_pension' => 'Protección S.A.'],
        ]);
    }
}
