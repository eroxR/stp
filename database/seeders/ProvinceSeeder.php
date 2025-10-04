<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::insert([
            [ 'department_name' => 'Amazonas', 'partner_country' => 114],
            [ 'department_name' => 'Antioquía', 'partner_country' => 114],
            [ 'department_name' => 'Arauca', 'partner_country' => 114],
            [ 'department_name' => 'Atlántico', 'partner_country' => 114],
            [ 'department_name' => 'Bolívar', 'partner_country' => 114],
            [ 'department_name' => 'Boyacá', 'partner_country' => 114],
            [ 'department_name' => 'Caldas', 'partner_country' => 114],
            [ 'department_name' => 'Caquetá', 'partner_country' => 114],
            [ 'department_name' => 'Casanare', 'partner_country' => 114],
            [ 'department_name' => 'Cauca', 'partner_country' => 114],
            [ 'department_name' => 'Cesar', 'partner_country' => 114],
            [ 'department_name' => 'Chocó', 'partner_country' => 114],
            [ 'department_name' => 'Córdoba', 'partner_country' => 114],
            [ 'department_name' => 'Cundinamarca', 'partner_country' => 114],
            [ 'department_name' => 'Guainía', 'partner_country' => 114],
            [ 'department_name' => 'Guaviare', 'partner_country' => 114],
            [ 'department_name' => 'Huila', 'partner_country' => 114],
            [ 'department_name' => 'La Guajira', 'partner_country' => 114],
            [ 'department_name' => 'Magdalena', 'partner_country' => 114],
            [ 'department_name' => 'Meta', 'partner_country' => 114],
            [ 'department_name' => 'Nariño', 'partner_country' => 114],
            [ 'department_name' => 'Norte de Santander', 'partner_country' => 114],
            [ 'department_name' => 'Putumayo', 'partner_country' => 114],
            [ 'department_name' => 'Quindío', 'partner_country' => 114],
            [ 'department_name' => 'Risaralda', 'partner_country' => 114],
            [ 'department_name' => 'San Andrés y Providencia', 'partner_country' => 114],
            [ 'department_name' => 'Santander', 'partner_country' => 114],
            [ 'department_name' => 'Sucre', 'partner_country' => 114],
            [ 'department_name' => 'Tolima', 'partner_country' => 114],
            [ 'department_name' => 'Valle del Cauca', 'partner_country' => 114],
            [ 'department_name' => 'Vaupés', 'partner_country' => 114],
            [ 'department_name' => 'Vichada', 'partner_country' => 114],
        ]);
    }
}
