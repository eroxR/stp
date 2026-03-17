<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
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
            // Si $isPlace es true, genera un nombre de lugar (ej: "Plaza Bolivar"), si no, un nombre de ciudad.
            'name_route' => $isPlace ? $this->faker->streetName : $this->faker->city,

            // Genera entre 1 y 3 frases para la descripción, haciendo que parezca un texto explicativo.
            'description_route' => $this->faker->sentences(rand(1, 3), true),

            // Selecciona aleatoriamente uno de los tres tipos de ruta que definiste.
            'type_route' => $this->faker->randomElement(['O', 'D', 'A']),

            // Asignamos los datos de la compañía y la sucursal.
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
