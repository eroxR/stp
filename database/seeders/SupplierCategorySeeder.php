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
            ['description_categorysupplier' => 'INSUMOS'],
            ['description_categorysupplier' => 'MANTENIMIENTOS'],
            ['description_categorysupplier' => 'SERVICIOS'],
            ['description_categorysupplier' => 'TRANSPORTES'],
        ]);
    }
}
