<?php

namespace Database\Seeders;

use App\Models\BrakeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrakeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BrakeType::insert([
            ['brake_type_description' => 'Frenos de disco'],
            ['brake_type_description' => 'Frenos de tambor'],
            ['brake_type_description' => 'Frenos ABS'],
            ['brake_type_description' => 'Freno de mano '],
        ]);
    }
}
