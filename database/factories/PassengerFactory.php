<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Identification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\passenger>
 */
class PassengerFactory extends Factory
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

        return [
            //
            'identification' => Identification::inRandomOrder()->first()->id,
            'identificationcard_passenger' => $this->faker->unique()->numerify('##########'),
            'names_lastnames' => $this->faker->name,
            'contract_id' => Contract::inRandomOrder()->first()->id,
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001'
        ];
    }
}
