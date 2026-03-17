<?php

namespace Database\Seeders;

use App\Models\Bonding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BondingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bonding::insert([
            ['bonding_type_description' => 'Contrato a Término Fijo'],
            ['bonding_type_description' => 'Contrato a término indefinido'],
            ['bonding_type_description' => 'Contrato de Obra o labor'],
            ['bonding_type_description' => 'Contrato civil por prestación de servicios'],
            ['bonding_type_description' => 'Contrato de aprendizaje'],
            ['bonding_type_description' => 'Contrato ocasional de trabajo'],
        ]);
    }
}
