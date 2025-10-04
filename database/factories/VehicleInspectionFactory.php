<?php

namespace Database\Factories;

use App\Models\Charge;
use App\Models\InspectionCategory;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleInspection>
 */
class VehicleInspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // --- 1. Definir variables base que se usarán en múltiples campos ---

        // Generamos fechas de inicio y fin lógicas
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +15 days');

        // Generamos kilometrajes lógicos
        $mileageStart = $this->faker->numberBetween(24000, 50000);
        $mileageEnd = $this->faker->numberBetween($mileageStart, $mileageStart + 1500);

        // --- 2. Lógica para el campo 'responsible' ---

        // Buscamos el ID del cargo "Conductor(a)"
        // Usamos firstOrFail para que falle si el seeder de Charge no ha corrido, lo cual es útil para depurar.
        $conductorChargeId = Charge::where('description_charge', 'Conductor(a)')->firstOrFail()->id;
        
        // Buscamos un usuario que sea conductor de forma robusta.
        $conductor = User::where('charge', $conductorChargeId)->inRandomOrder()->first();

        // Si no encontramos un conductor (quizás el seeder aún no los crea), creamos uno sobre la marcha.
        // Esto asume que tienes el estado `asConductor` en tu UserFactory.
        if (!$conductor) {
            $conductor = User::factory()->asConductor()->create();
        }

        // Concatenamos para obtener el nombre completo.
        $responsibleName = $conductor->firstname . ' ' . $conductor->lastname;


        // --- 3. Lógica para el campo 'array_inspection' (Generación del JSON) ---

        // Obtenemos todas las categorías con sus items de inspección de una sola vez (muy eficiente)
        $categories = InspectionCategory::with('inspections')->get();

        // Creamos el rango de fechas para la inspección
        $dateRange = CarbonPeriod::create($startDate, $endDate);

        $inspectionJson = [];
        
        // Iteramos sobre cada categoría ("EQUIPO CARRETERA", "LUCES", etc.)
        foreach ($categories as $category) {
            $itemsData = [];
            // Iteramos sobre cada item dentro de la categoría ("LINTERNA", "BOTIQUIN", etc.)
            foreach ($category->inspections as $item) {
                $dailyChecks = [];
                // Iteramos sobre cada día del rango de fechas
                foreach ($dateRange as $date) {
                    $dailyChecks[] = [
                        'valido' => $this->faker->randomElement(['0', '1', '2']), // 0=No, 1=Si, 2=N/A
                        'fecha' => $date->format('Y/m/d'),
                        'obs' => '', // Lo dejamos vacío como en tu ejemplo
                    ];
                }
                $itemsData[$item->name_description] = $dailyChecks;
            }
            $inspectionJson[$category->name_description] = $itemsData;
        }


        return [
            'id_vehicle' => Vehicle::inRandomOrder()->first()->id,
            'dates_start' => $startDate->format('Y-m-d'),
            'dates_end' => $endDate->format('Y-m-d'),
            'responsible' => $responsibleName,
            'mileage_start' => $mileageStart,
            'mileage_end' => $mileageEnd,
            'array_inspection' => $inspectionJson, // Eloquent lo codificará a JSON automáticamente
        ];
    }
}
