<?php

namespace Database\Seeders;

use App\Models\LicenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LicenseCategory::insert([
            [
                'code_licensecategory' => 'A1',
                'description_licensecategory' => 'Motocicletas con cilindrada hasta 125 c.c.'
            ],
            [
                'code_licensecategory' => 'A2',
                'description_licensecategory' => 'Motocicletas, motocicletas y moto triciclos con cilindrada mayor a 125 c.c.'
            ],
            [
                'code_licensecategory' => 'B1',
                'description_licensecategory' => 'Automóviles, motocarros, cuatrimotos, camperos, camionetas y microbuses de servicio particular.'
            ],
            [
                'code_licensecategory' => 'B2',
                'description_licensecategory' => 'Camiones rígidos, busetas y buses de servicio particular.'
            ],
            [
                'code_licensecategory' => 'B3',
                'description_licensecategory' => 'Vehículos articulados servicio particular.'
            ],
            [
                'code_licensecategory' => 'C1',
                'description_licensecategory' => 'Automóviles, camperos, camionetas y microbuses de servicio público.'
            ],
            [
                'code_licensecategory' => 'C2',
                'description_licensecategory' => 'Camiones rígidos, busetas y buses de servicio público.'
            ],
            [
                'code_licensecategory' => 'C3',
                'description_licensecategory' => 'Vehículos articulados servicio público.'
            ],
        ]);
    }
}
