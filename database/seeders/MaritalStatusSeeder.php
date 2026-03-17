<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaritalStatus::insert([
            ['description_maritalstatus' => 'Soltero/a'],
            ['description_maritalstatus' => 'Casado/a'],
            ['description_maritalstatus' => 'Unión libre o unión de hecho'],
            ['description_maritalstatus' => 'Separado/a'],
            ['description_maritalstatus' => 'Divorciado/a'],
            ['description_maritalstatus' => 'Viudo/a'],
        ]);
    }
}
