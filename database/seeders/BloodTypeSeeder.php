<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BloodType::insert([
            ['blood_type_description' => 'O-'],
            ['blood_type_description' => 'O+'],
            ['blood_type_description' => 'A-'],
            ['blood_type_description' => 'A+'],
            ['blood_type_description' => 'B-'],
            ['blood_type_description' => 'B+'],
            ['blood_type_description' => 'AB-'],
            ['blood_type_description' => 'AB+'],
        ]);
    }
}
