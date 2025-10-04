<?php

namespace Database\Seeders;

use App\Models\period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        period::insert([
            ['name_period' => '1 dia','days_period' => 1],
            ['name_period' => '5 dias','days_period' => 5],
            ['name_period' => '1 semana','days_period' => 7],
            ['name_period' => '2 semanas','days_period' => 14],
            ['name_period' => '3 semanas','days_period' => 21],
            ['name_period' => '1 mes','days_period' => 30],
            ['name_period' => '2 meses','days_period' => 60],
            ['name_period' => '3 meses','days_period' => 90],
            ['name_period' => '4 meses','days_period' => 120],
            ['name_period' => '5 meses','days_period' => 150],
            ['name_period' => '6 meses','days_period' => 180],
            ['name_period' => '1 año','days_period' => 365],
            ['name_period' => '1 año y 1 mes','days_period' => 396],
            ['name_period' => '1 año y 2 meses','days_period' => 425],
            ['name_period' => '1 año y 3 meses','days_period' => 455],
            ['name_period' => '1 año y 4 meses','days_period' => 485],
            ['name_period' => '1 año y 5 meses','days_period' => 515],
            ['name_period' => '1 año y 6 meses','days_period' => 545],
            ['name_period' => '1 año y 7 meses','days_period' => 575],
            ['name_period' => '1 año y 8 meses','days_period' => 605],
            ['name_period' => '1 año y 9 meses','days_period' => 635],
            ['name_period' => '1 año y 10 meses','days_period' => 665],
            ['name_period' => '1 año y 11 meses','days_period' => 695],
            ['name_period' => '2 años','days_period' => 730],
            ['name_period' => '2 años y 1 mes','days_period' => 761],
            ['name_period' => '2 años y 2 meses','days_period' => 790],
            ['name_period' => '2 años y 3 meses','days_period' => 820],
            ['name_period' => '2 años y 4 meses','days_period' => 850],
            ['name_period' => '2 años y 5 meses','days_period' => 880],
            ['name_period' => '2 años y 6 meses','days_period' => 910],
            ['name_period' => '2 años y 7 meses','days_period' => 940],
            ['name_period' => '2 años y 8 meses','days_period' => 970],
            ['name_period' => '2 años y 9 meses','days_period' => 1000],
            ['name_period' => '2 años y 10 meses','days_period' => 1030],
            ['name_period' => '2 años y 11 meses','days_period' => 1060],
            ['name_period' => '3 años','days_period' => 1095],
            ['name_period' => '3 años y 1 mes','days_period' => 1126],
            ['name_period' => '3 años y 2 meses','days_period' => 1155],
            ['name_period' => '3 años y 3 meses','days_period' => 1185],
            ['name_period' => '3 años y 4 meses','days_period' => 1215],
            ['name_period' => '3 años y 5 meses','days_period' => 1245],
            ['name_period' => '3 años y 6 meses','days_period' => 1275],
            ['name_period' => '3 años y 7 meses','days_period' => 1305],
            ['name_period' => '3 años y 8 meses','days_period' => 1335],
            ['name_period' => '3 años y 9 meses','days_period' => 1365],
            ['name_period' => '3 años y 10 meses','days_period' => 1395],
            ['name_period' => '3 años y 11 meses','days_period' => 1425],
            ['name_period' => '4 años','days_period' => 1460],
            ['name_period' => '4 años y 1 mes','days_period' => 1491],
            ['name_period' => '4 años y 2 meses','days_period' => 1520],
            ['name_period' => '4 años y 3 meses','days_period' => 1550],
            ['name_period' => '4 años y 4 meses','days_period' => 1580],
            ['name_period' => '4 años y 5 meses','days_period' => 1610],
            ['name_period' => '4 años y 6 meses','days_period' => 1640],
            ['name_period' => '4 años y 7 meses','days_period' => 1670],
            ['name_period' => '4 años y 8 meses','days_period' => 1700],
            ['name_period' => '4 años y 9 meses','days_period' => 1730],
            ['name_period' => '4 años y 10 meses','days_period' => 1760],
            ['name_period' => '4 años y 11 meses','days_period' => 1790],
            ['name_period' => '5 años','days_period' => 1825],
            ['name_period' => '5 años y 1 mes','days_period' => 1856],
            ['name_period' => '5 años y 2 meses','days_period' => 1885],
            ['name_period' => '5 años y 3 meses','days_period' => 1915],
            ['name_period' => '5 años y 4 meses','days_period' => 1945],
            ['name_period' => '5 años y 5 meses','days_period' => 1975],
            ['name_period' => '5 años y 6 meses','days_period' => 2005],
            ['name_period' => '5 años y 7 meses','days_period' => 2035],
            ['name_period' => '5 años y 8 meses','days_period' => 2065],
            ['name_period' => '5 años y 9 meses','days_period' => 2095],
            ['name_period' => '5 años y 10 meses','days_period' => 2125],
            ['name_period' => '5 años y 11 meses','days_period' => 2155],
            ['name_period' => '6 años','days_period' => 2190],
        ]);
    }
}
