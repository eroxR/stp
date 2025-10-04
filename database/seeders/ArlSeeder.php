<?php

namespace Database\Seeders;

use App\Models\Arl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Arl::insert(
            [
                ['description_arl' => 'ARL Sura'],
                ['description_arl' => 'Aseguradora de Vida Colseguros'],
                ['description_arl' => 'BBVA Seguros de Vida'],
                ['description_arl' => 'Colmena S.A.  Seguros'],
                ['description_arl' => 'Colpatria Seguros S.A'],
                ['description_arl' => 'Compañia Agricola de seguros de Vida'],
                ['description_arl' => 'Compañia Central de Seguros'],
                ['description_arl' => 'Compañia de Seguros de Vida Aurora S.A.'],
                ['description_arl' => 'La Equidad Seguros'],
                ['description_arl' => 'La Previsora Vida S.A.'],
                ['description_arl' => 'Liberty Seguros S.A.'],
                ['description_arl' => 'Mapfre Colombia Vida Seguros S.A.'],
                ['description_arl' => 'Positiva Compañia de Seguros'],
                ['description_arl' => 'Seguros Bolivar S.A.'],
                ['description_arl' => 'Seguros de Vida ALFA S.A.'],
                ['description_arl' => 'Seguros de Vida del Estado'],
        ]);
    }
}
