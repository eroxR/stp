<?php

namespace Database\Seeders;

use App\Models\SupplierCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        SupplierCategory::insert([
            ['description_CategorySupplier' => 'INSUMOS'],
            ['description_CategorySupplier' => 'MANTENIMIENTOS'],
            ['description_CategorySupplier' => 'SERVICIOS'],
            ['description_CategorySupplier' => 'TRANSPORTES'],
        ]);
    }
}
