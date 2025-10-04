<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Contract;
use App\Models\ContractType;
use App\Models\Identification;
use App\Models\order;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{

     /**
     * Mantiene un registro del último número de contrato para cada par de (empresa, tipo).
     * Esto evita consultar la base de datos para cada contrato, haciendo el seeding muy rápido.
     * @var array
     */
    protected static array $lastContractNumber = [];

    // ...

    /**
     * Genera el siguiente número de contrato consecutivo basado en la empresa y el tipo de contrato.
     *
     * @param int $companyId
     * @param \App\Models\ContractType $contractType
     * @return int
     */
    private function generateNextContractNumber(int $companyId, ContractType $contractType): int
    {
        $typeId = $contractType->id;

        // Si es la primera vez que vemos este par (empresa, tipo), necesitamos inicializar el contador.
        if (!isset(self::$lastContractNumber[$companyId][$typeId])) {
            // 1. Buscamos el número más alto que YA exista en la base de datos para este par.
            $dbMax = Contract::where('company_id', $companyId)
                             ->where('type_contract', $typeId)
                             ->max('contract_number');

            // 2. Determinamos el número de inicio según las reglas de negocio.
            $startNumber = match ($contractType->contract_name) { // Asume que la columna se llama 'contract_name'
                'Empresas' => 3000,
                'Empresa Turismo' => 4500,
                'Usuarios de Servicios de Salud' => 6000,
                'Ocacionales' => 7000,
                default => 1, // 'Colegios', 'Vinculación', 'Convenio Empresarial' y cualquier otro.
            };

            // 3. Nuestro contador inicial será el mayor entre el que ya existe en la BD
            //    y el número de inicio configurado, o el número de inicio - 1 si no hay nada en la BD.
            self::$lastContractNumber[$companyId][$typeId] = max($dbMax ?? 0, $startNumber - 1);
        }

        // Incrementamos y devolvemos el nuevo número de contrato.
        return ++self::$lastContractNumber[$companyId][$typeId];
    }

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

        $cooperation = $this->faker->randomElement(['1', '2']);
        $contractType = ContractType::inRandomOrder()->first();
        $dateStart = $this->faker->dateTimeBetween('now', '+1 year');
        // $cooperation = $this->faker->randomElement(['1', '0']);

        $contractNumber = $this->generateNextContractNumber($companyData['id'], $contractType);

        $data = [
            'contract_number' => $contractNumber,
            'code_order' => Order::inRandomOrder()->first()->id,
            'type_contract' => $contractType->id,
            'origin_route' => Route::inRandomOrder()->first()->id,
            'destination_route' => Route::inRandomOrder()->first()->id,
            'date_start_contract' => $dateStart,
            'contract_end_date' => $this->faker->dateTimeBetween($dateStart, '+2 years'),
            'contract_value' => $this->faker->numberBetween(1000000, 12000000),
            'contracting_name' => $this->faker->name,
            'status_contract' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'identification' => Identification::inRandomOrder()->first()->id,
            'contract_document' => $this->faker->unique()->numerify('##########'),
            // CORRECCIÓN: Formatear la fecha para evitar errores al concatenar con un string
            'expedition_identificationcard' => $this->faker->dateTimeBetween('-50 years', 'now')->format('Y-m-d') . ' en ' . City::inRandomOrder()->first()->city_name,
            'contracting_phone' => $this->faker->phoneNumber,
            'contracting_direction' => $this->faker->address,
            'contracting_email' => $this->faker->unique()->safeEmail(),
            'legal_representative' =>  'Pedro Jose Ramirez',
            'identification_represent_legal' => 1,
            'identificationcard_represent_legal' => '65847125',
            'legal_representative_expedition_identificationcard' => '1975-03-27 en Bogota',
            'passenger_quantity' => $this->faker->numberBetween(45, 105),
            'total_disposition' => $this->faker->randomElement(['1', '2']),
            'quantity_vehicle' => $this->faker->numberBetween(1, 8),
            'validate_cooperation_contract' => $cooperation,
            'cooperation_contract' => $cooperation == '1' ? $this->faker->company : null,
            'secure_policy' => 'Seguros Bolivar',
            'tipe_pay' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
            'contract_signing_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'signature_place' => 'Dosquebradas',
            'departure_location' => City::inRandomOrder()->first()->city_name,
            'place_arrival' => City::inRandomOrder()->first()->city_name,
            'place_return' => City::inRandomOrder()->first()->city_name,
            'date_departure_location' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'date_place_arrival' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'date_place_return' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'identificationcard_representative_group' => $this->faker->unique()->numerify('##########'),
            'group_representative_name' => $this->faker->name,
            'dateofexpedition_representative_group' => $this->faker->dateTimeBetween('-50 years', 'now')->format('Y-m-d') . ' en ' . City::inRandomOrder()->first()->city_name,
            'digital_signature' => '',
            'digital_signature_representative_group' => '',
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',

            // --- Campos condicionales inicializados como nulos ---
            'school_name' => null,
            'address_school' => null,
            'phone_school' => null,
            'school_year' => null,
            'student_name' => null,
            'identificationcard_estudent' => null,
            'grade_student' => null,
            'family_relationship' => null,
            'who_receives' => null,
            'start_day' => null,
            'End_day' => null,
            'legal_bond' => null,
        ];

        $typeCode = strtoupper(substr($contractType->name, 0, 3));

        if ($contractType->id == 1) {
            $data['school_name'] = $this->faker->company . ' School';
            $data['address_school'] = $this->faker->address;
            $data['phone_school'] = $this->faker->phoneNumber;
            $data['school_year'] = $dateStart->format('Y');
            $data['student_name'] = $this->faker->name;
            $data['identificationcard_estudent'] = $this->faker->unique()->numerify('##########');
            $data['grade_student'] = $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $data['family_relationship'] = $this->faker->randomElement(['Padre', 'Madre', 'Tutor Legal']);
            $data['who_receives'] = $this->faker->name;
            $data['start_day'] = $this->faker->time('H:i:s');
            $data['End_day'] = $this->faker->time('H:i:s');
        }

        // Si es un contrato de tipo 7
        if ($contractType->id == 7) {
            $data['legal_bond'] = $this->faker->randomElement(['1', '2']);;
        }

        return $data;
    }
}
