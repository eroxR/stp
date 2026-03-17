<?php

namespace Database\Seeders;

use App\Models\Relationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relationship::insert([
            ['description_relationship' => 'Abuelo(a)'],
            ['description_relationship' => 'Abuelo(a) del cónyuge'],
            ['description_relationship' => 'Bisabuelo(a)'],
            ['description_relationship' => 'Bisabuelo(a) del cónyuge'],
            ['description_relationship' => 'Bisnieto(a)'],
            ['description_relationship' => 'cónyuge'],
            ['description_relationship' => 'Cuñado(a)'],
            ['description_relationship' => 'Hermano(a)'],
            ['description_relationship' => 'Hijo(a)'],
            ['description_relationship' => 'Madre'],
            ['description_relationship' => 'Nieto(a)'],
            ['description_relationship' => 'Nuera'],
            ['description_relationship' => 'Padre'],
            ['description_relationship' => 'Primo(a)'],
            ['description_relationship' => 'Primo(a) del cónyuge'],
            ['description_relationship' => 'Sobrino(a)'],
            ['description_relationship' => 'Sobrino(a) del cónyuge'],
            ['description_relationship' => 'Suegro(a)'],
            ['description_relationship' => 'Tatarabuelo(a)'],
            ['description_relationship' => 'Tatarabuelo(a) del cónyuge'],
            ['description_relationship' => 'Tataranieto(a)'],
            ['description_relationship' => 'Tío(a)'],
            ['description_relationship' => 'Tío(a) del cónyuge'],
            ['description_relationship' => 'Yerno'],
        ]);
    }
}
