<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Branch::insert([
            [
                'code_branch' => '001',
                'name_branch' => 'Oficina Principal',
                'address_branch' => 'Calle 123 # 45-67',
                'phone_branch' => '+57 300 1234567',
                'email_branch' => 'info@stp.com',
                'city_branch' => 'Dosquebradas',
                'province_branch' => 'Risaralda',
                'country_branch' => 'Colombia',
                'postal_code_branch' => '111111',
                'manager_branch' => 'Alba Hidalgo Osiris',
                'number_employees_branch' => 100,
                'status_branch' => '1',
                'company_id' => 1,
                'code_company' => '001',
            ],
            [
                'code_branch' => '001',
                'name_branch' => 'Oficina Principal',
                'address_branch' => 'Calle 100 # 45 - 67',
                'phone_branch' => '3101234567',
                'email_branch' => 'contacto@veloz.com',
                'city_branch' => 'Cundinamarca',
                'province_branch' => 'Bogota',
                'country_branch' => 'Colombia',
                'postal_code_branch' => '110111',
                'manager_branch' => 'Jose Miguel Garcia Lopez',
                'number_employees_branch' => 250,
                'status_branch' => '1',
                'company_id' => 2,
                'code_company' => '001',
            ],
            [
                'code_branch' => '001',
                'name_branch' => 'Oficina Principal',
                'address_branch' => 'Carrera 15 # 80 - 20',
                'phone_branch' => '3209876543',
                'email_branch' => 'info@cargasegura.com',
                'city_branch' => 'Dosquebradas',
                'province_branch' => 'Risaralda',
                'country_branch' => 'Colombia',
                'postal_code_branch' => '6000001',
                'manager_branch' => 'Ana Rodríguez',
                'number_employees_branch' => 120,
                'status_branch' => '1',
                'company_id' => 3,
                'code_company' => '002',
            ],
        ]);
    }
}
