<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Permit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permit>
 */
class PermitFactory extends Factory
{
    protected static $lastPermitNumber = [];
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

        $contract = Contract::inRandomOrder()->first();
        $permitStartDate = $this->faker->dateTimeBetween('-2 years', 'now');

        // --- 2. Lógica para permit_number (Consecutivo por contrato) ---
        $contractId = $contract->id;

        // Si es la primera vez que vemos este contrato en esta ejecución...
        if (!isset(self::$lastPermitNumber[$contractId])) {
            // ...buscamos en la BD el número más alto que ya exista para este contrato
            // y lo guardamos en nuestra "memoria" estática. Si no hay, empezamos en 0.
            self::$lastPermitNumber[$contractId] = Permit::where('contract', $contractId)->max('permit_number') ?? 0;
        }

        // Incrementamos el número para este contrato en nuestra memoria y lo usamos.
        self::$lastPermitNumber[$contractId]++;
        $permitNumber = self::$lastPermitNumber[$contractId];

        // --- 3. Lógica para permit_code (Código basado en fecha) ---
        $year = $permitStartDate->format('Y'); // Extrae los 4 dígitos del año.
        $permitCode = '366003616' . $year . '1507';


        return [
            'contract' => $contractId,
            'permit_start_date' => $permitStartDate,
            'permit_end_date' => $this->faker->dateTimeBetween($permitStartDate, '+1 year'),
            'permit_number' => $permitNumber,
            'permit_code' => $permitCode,
            'fuec_status' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
        ];
    }
}
