<?php

namespace Database\Factories;

use App\Models\LicenseCategory;
use App\Models\period;
use App\Models\User;
use Database\Seeders\PeriodSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected static $availableUserIds = null;
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

        if (is_null(self::$availableUserIds)) {
            // Obtenemos todos los IDs de usuarios con charge=9, los barajamos y los guardamos.
            self::$availableUserIds = User::where('charge', 10)->pluck('id')->shuffle();
        }

        // Sacamos el último ID de la lista. `pop()` lo extrae y lo elimina, garantizando unicidad.
        $userId = self::$availableUserIds->pop();

        // Si la lista se queda vacía, creamos un nuevo usuario para no fallar.
        // if (is_null($userId)) {
        //     $userId = User::factory()->create(['charge' => 9])->id;
        // }


        return [
            //
            'user_id' => $userId,
            'license_number' => $this->faker->unique()->numerify('##########'),
            'license_category' => LicenseCategory::inRandomOrder()->first()->id,
            'license_expiration' => $this->faker->dateTimeBetween('now', '+5 years'),
            'priority_license_expiration' => $this->faker->randomElement(['1', '0']),
            'period_license' => Period::inRandomOrder()->first()->id,
            'certificate_drugs_alchoolemia' => $this->faker->dateTimeBetween('now', '+1 year'),
            'priority_certificate_drugs_alchoolemia' => $this->faker->randomElement(['1', '0']),
            'period_certificate_drugs_alchoolemia' => Period::inRandomOrder()->first()->id,
            'simit_queries' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'priority_simit_queries' => $this->faker->randomElement(['1', '0']),
            'period_simit_queries' => Period::inRandomOrder()->first()->id,
            'rules_transit' => $this->faker->dateTimeBetween('now', '+2 years'),
            'priority_rules_transit' => $this->faker->randomElement(['1', '0']),
            'period_rules_transit' => Period::inRandomOrder()->first()->id,
            'defensive_driving' => $this->faker->dateTimeBetween('now', '+2 years'),
            'priority_defensive_driving' => $this->faker->randomElement(['1', '0']),
            'period_defensive_driving' => Period::inRandomOrder()->first()->id,
            'first_aid' => $this->faker->dateTimeBetween('now', '+2 years'),
            'priority_first_aid' => $this->faker->randomElement(['1', '0']),
            'period_first_aid' => Period::inRandomOrder()->first()->id,
            'psicosensometrico' => $this->faker->dateTimeBetween('now', '+3 years'),
            'priority_psicosensometrico' => $this->faker->randomElement(['1', '0']),
            'period_psicosensometrico' => Period::inRandomOrder()->first()->id,
            'road_safety' => $this->faker->dateTimeBetween('now', '+2 years'),
            'priority_road_safety' => $this->faker->randomElement(['1', '0']),
            'period_road_safety' => Period::inRandomOrder()->first()->id,
            'driver_status' => $this->faker->randomElement(['1', '2']),
            'linked' => User::where('usertype', 6)->inRandomOrder()->first()->id,
            'isLinked' => $this->faker->randomElement(['1', '0']),
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
