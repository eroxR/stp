<?php

namespace Database\Seeders;

use App\Models\EducationalLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EducationalLevel::insert([
            ['description_leveleducation' => 'Carrera Profesional'],
            ['description_leveleducation' => 'Carrera Profesional sin Terminar'],
            ['description_leveleducation' => 'Doctorado'],
            ['description_leveleducation' => 'Doctorado sin Terminar'],
            ['description_leveleducation' => 'Ninguno'],
            ['description_leveleducation' => 'Postgrado'],
            ['description_leveleducation' => 'Postgrado sin Terminar'],
            ['description_leveleducation' => 'Primaria'],
            ['description_leveleducation' => 'Primaria Incompleta'],
            ['description_leveleducation' => 'Segundaria'],
            ['description_leveleducation' => 'Segundaria Incompleta'],
            ['description_leveleducation' => 'Tecnico'],
            ['description_leveleducation' => 'Tecnico sin Terminar'],
            ['description_leveleducation' => 'Tecnologo'],
            ['description_leveleducation' => 'Tecnologo sin Terminar'],
        ]);
    }
}
