<?php

namespace Database\Seeders;

use App\Models\InspectionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InspectionCategory::insert([
            ['name_description' => 'EQUIPO CARRETERA'],
            ['name_description' => 'NIVELES DE FLUIDOS'],
            ['name_description' => 'LUCES'],
            ['name_description' => 'OTROS'],
        ]);
    }
}
