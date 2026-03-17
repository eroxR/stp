<?php

namespace Database\Factories;

use App\Models\BrakeType;
use App\Models\DimensionRim;
use App\Models\period;
use App\Models\User;
use App\Models\VehicleBrand;
use App\Models\VehicleClass;
use App\Models\VehicleLine;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
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
            'plate_vehicle' => Str::upper(Str::random(3)) . $this->faker->randomNumber(3),
            'brand_vehicle' => VehicleBrand::inRandomOrder()->first()->id,
            'vehicle_line' => VehicleLine::inRandomOrder()->first()->id,
            'registration_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'model_vehicle' => $this->faker->dateTimeBetween('-7 years', 'now')->format('Y'),
            'vehicle_chassis_number' => $this->faker->regexify('[A-Za-z0-9]{12,14}'),
            'engine_number' => $this->faker->regexify('[A-Za-z0-9]{12,14}'),
            'property_card_number' => $this->faker->regexify('[A-Za-z0-9]{12,14}'),
            'cylinder_vehicle' => $this->faker->numberBetween(1200, 2100),
            'vehicle_type' => VehicleType::inRandomOrder()->first()->id,
            'side_vehicle' => '0' . $this->faker->unique()->randomNumber(2),
            'owner_vehicle' => User::where('usertype', 6)->inRandomOrder()->first()->id,
            'driver_id' => User::where('usertype', 6)->inRandomOrder()->first()->id,
            'number_passenger' => $this->faker->numberBetween(14, 45),
            'internal_external_owner_type' => $this->faker->randomElement(['1', '2']),
            'infrastructure_vehicle' => VehicleClass::inRandomOrder()->first()->id,
            'vehicle_authorization' => $this->faker->randomElement(['1', '2', '3']),
            'status_vehicle' => $this->faker->randomElement(['1', '2']),
            'admission_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'vehicle_pickup_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'vehicle_refund' => $this->faker->dateTimeBetween('now', '+2 years'),
            'service' => 'PUBLICO',
            'color_vehicle' => $this->faker->randomElement(['Rojo', 'Verde', 'Azul', 'Negro', 'Blanco']),
            'type_direction' => $this->faker->randomElement(['1', '2', '3']),
            'front_suspension' => $this->faker->randomElement(['1', '2', '3']),
            'rear_suspension' => $this->faker->randomElement(['1', '2', '3']),
            'dimension_rims' => DimensionRim::inRandomOrder()->first()->id,
            'rear_brake_type' => BrakeType::inRandomOrder()->first()->id,
            'front_brake_type' => BrakeType::inRandomOrder()->first()->id,
            // 'binding_contract' => ,
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
