<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::insert([
            ['description_usertype' => 'Super Usuario'],
            ['description_usertype' => 'Administrador'],
            ['description_usertype' => 'Cliente'],
            ['description_usertype' => 'Empleado'],
            ['description_usertype' => 'Proveedor'],
            ['description_usertype' => 'Vinculado'],
        ]);
    }
}
