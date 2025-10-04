<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
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

        $requesterIsCompany = $this->faker->boolean;

        return [
            //
        'consecutive_order' => Str::upper(Str::random(3)) . '-' . $this->faker->unique()->randomNumber(5),
        'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        'requester_name' => $requesterIsCompany ? $this->faker->company : $this->faker->name,
        'requester_phone' =>  $this->faker->phoneNumber,
        'requester_email' => $this->faker->unique()->safeEmail,
        'order_reason' => $this->faker->paragraphs(3, true),
        'order_status' => $this->faker->randomElement(['1', '2', '3']),
        'company_id' => $companyData['id'],
        'code_company' => $companyData['code'],
        'branch_id' => '001',
        ];
    }
}
