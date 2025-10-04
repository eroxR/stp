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
                'code_licenseCategory' => 'A1',
                'description_licenseCategory' => 'Motocicletas con cilindrada hasta 125 c.c.'
            ],
            [
                'code_licenseCategory' => 'A2',
                'description_licenseCategory' => 'Motocicletas, motocicletas y moto triciclos con cilindrada mayor a 125 c.c.'
            ],
            [
                'code_licenseCategory' => 'B1',
                'description_licenseCategory' => 'Automóviles, motocarros, cuatrimotos, camperos, camionetas y microbuses de servicio particular.'
            ],
            [
                'code_licenseCategory' => 'B2',
                'description_licenseCategory' => 'Camiones rígidos, busetas y buses de servicio particular.'
            ],
            [
                'code_licenseCategory' => 'B3',
                'description_licenseCategory' => 'Vehículos articulados servicio particular.'
            ],
            [
                'code_licenseCategory' => 'C1',
                'description_licenseCategory' => 'Automóviles, camperos, camionetas y microbuses de servicio público.'
            ],
            [
                'code_licenseCategory' => 'C2',
                'description_licenseCategory' => 'Camiones rígidos, busetas y buses de servicio público.'
            ],
            [
                'code_licenseCategory' => 'C3',
                'description_licenseCategory' => 'Vehículos articulados servicio público.'
            ],
        ]);
    }
}
