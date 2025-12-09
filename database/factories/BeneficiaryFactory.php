<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beneficiary>
 */
class BeneficiaryFactory extends Factory
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
            'full_name' => $this->faker->name,
            'identificationcard' => $this->faker->unique()->numerify('##########'),
            'beneficiarytype' => $this->faker->randomElement(['1', '2', '3']),
            'user_id' => User::where('charge', 10)->inRandomOrder()->first()->id,
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
