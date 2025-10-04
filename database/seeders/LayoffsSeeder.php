<?php

namespace Database\Seeders;

use App\Models\Layoffs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayoffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layoffs::insert([
            ['description_layoffs' => 'Askandia S.A.'],
            ['description_layoffs' => 'Cesantías de Colombia S.A.'],
            ['description_layoffs' => 'Colfondos'],
            ['description_layoffs' => 'Colmena'],
            ['description_layoffs' => 'Colpatria'],
            ['description_layoffs' => 'Collayoffses'],
            ['description_layoffs' => 'Davivir S.A.'],
            ['description_layoffs' => 'Dinners S.A.'],
            ['description_layoffs' => 'Fondo Nacional del Ahorro'],
            ['description_layoffs' => 'Granfondo S.A.'],
            ['description_layoffs' => 'Invermañana'],
            ['description_layoffs' => 'Invertir'],
            ['description_layoffs' => 'Old Mutual'],
            ['description_layoffs' => 'Porvenir S.A.'],
            ['description_layoffs' => 'Protección S.A.'],
        ]);
    }
}
