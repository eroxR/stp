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
            ['description_levelEducation' => 'Carrera Profesional'],
            ['description_levelEducation' => 'Carrera Profesional sin Terminar'],
            ['description_levelEducation' => 'Doctorado'],
            ['description_levelEducation' => 'Doctorado sin Terminar'],
            ['description_levelEducation' => 'Ninguno'],
            ['description_levelEducation' => 'Postgrado'],
            ['description_levelEducation' => 'Postgrado sin Terminar'],
            ['description_levelEducation' => 'Primaria'],
            ['description_levelEducation' => 'Primaria Incompleta'],
            ['description_levelEducation' => 'Segundaria'],
            ['description_levelEducation' => 'Segundaria Incompleta'],
            ['description_levelEducation' => 'Tecnico'],
            ['description_levelEducation' => 'Tecnico sin Terminar'],
            ['description_levelEducation' => 'Tecnologo'],
            ['description_levelEducation' => 'Tecnologo sin Terminar'],
        ]);
    }
}
