<?php

namespace Database\Seeders;

use App\Models\Accident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Accident::factory()->count(60)->create();
    }
}
