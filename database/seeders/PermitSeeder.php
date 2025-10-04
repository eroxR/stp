<?php

namespace Database\Seeders;

use App\Models\Permit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permit::factory()->count(216)->create();
    }
}
