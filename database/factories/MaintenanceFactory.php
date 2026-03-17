<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\maintenance>
 */
class MaintenanceFactory extends Factory
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
            'vehicle_id' => Vehicle::inRandomOrder()->first()->id,
            'usuario_id' =>  User::where('charge', 10)->inRandomOrder()->first()->id,
            'maintenance_provider' => $this->faker->company,
            'maintenance_date' => $this->faker->dateTimeBetween('now', '+5 years'),
            'mileage' => $this->faker->numberBetween(1100000, 4500000),
            'type_maintenance' => $this->faker->randomElement(['1', '2']),
            'description' => $this->faker->paragraphs(2, true),
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
