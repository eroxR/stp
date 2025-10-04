<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accident>
 */
class AccidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyData = $this->faker->randomElement([
            ['id' => 2, 'code' => '001'],
            ['id' => 3, 'code' => '002'],
        ]);

        $isPlace = $this->faker->boolean;

        return [
            //
            'accident_place' => $isPlace ? $this->faker->streetName : $this->faker->city,
            'date_accident' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'accident_description' => $this->faker->paragraphs(3, true),
            'comparing_number' => $this->faker->unique()->numerify('##########'),
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
