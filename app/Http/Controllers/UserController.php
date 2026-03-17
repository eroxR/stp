<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\BloodType;
use App\Models\Bonding;
use App\Models\Charge;
use App\Models\City;
use App\Models\CompensationBox;
use App\Models\Country;
use App\Models\EducationalLevel;
use App\Models\Entity;
use App\Models\HealthEntity;
use App\Models\Identification;
use App\Models\Layoffs;
use App\Models\MaritalStatus;
use App\Models\Pension;
use App\Models\Province;
use App\Models\Relationship;
use App\Models\ShoeSize;
use App\Models\User;
use App\Models\UserType;
use App\Models\WorkArea;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function employees()
    {
        $relationships = [
            'countryData:id,country_name',
            'ProvinceData:id,department_name',
            'cityData:id,city_name',
            'arlData:id,description_arl',
            'bloodTypeData:id,blood_type_description',
            'bondingData:id,bonding_type_description',
            'chargeData:id,description_charge',
            'compensationBoxData:id,description_compensationbox',
            'educationLevelData:id,description_leveleducation',
            'healthEntityData:id,description_eps',
            'identificationData:id,description_identification',
            'layoffsData:id,description_layoffs',
            'civilStatusData:id,description_maritalstatus',
            'pensionData:id,description_pension',
            'relationshipData:id,description_relationship',
            'shoeSizeData:id,description_shoesize',
            'usertypeData:id,description_usertype',
            'workAreaData:id,workarea_description',
            'cityBirthData:id,city_name',
            'companyData:id,name_company',
            'branchData:id,name_branch'

        ];

        $catalogs = [
            'charges' => Charge::select('id', 'description_charge')->get(),
            'cities' => City::select('id', 'city_name')->get(),
            'countries' => Country::select('id', 'country_name')->get(),
            'civilStatuses' => MaritalStatus::select('id', 'description_maritalstatus')->get(),
            'workAreas' => WorkArea::select('id', 'workarea_description')->get(),
            'shoeSizes' => ShoeSize::select('id', 'description_shoesize')->get(),
            'Provinces' => Province::select('id', 'department_name')->get(),
            'arls' => Entity::whereJsonContains('type_entity', 'A')->pluck('id', 'company_name_provider')->get(),
            'bloodTypes' => BloodType::select('id', 'blood_type_description')->get(),
            'bondings' => Bonding::select('id', 'bonding_type_description')->get(),
            'compensationBoxes' => Entity::whereJsonContains('type_entity', 'C')->pluck('id', 'company_name_provider')->get(),
            'educationLevels' => EducationalLevel::select('id', 'description_leveleducation')->get(),
            'healthEntities' => Entity::whereJsonContains('type_entity', 'H')->pluck('id', 'company_name_provider')->get(),
            'identifications' => Identification::select('id', 'description_identification')->get(),
            'layoffs' => Entity::whereJsonContains('type_entity', 'L')->pluck('id', 'company_name_provider')->get(),
            'pensions' => Entity::whereJsonContains('type_entity', 'P')->pluck('id', 'company_name_provider')->get(),
            'relationships' => Relationship::select('id', 'description_relationship')->get(),
            'userTypes' => UserType::select('id', 'description_usertype')->get(),
            // ... agrega los demás modelos necesarios (EPS, ARL, etc.)
        ];
        // dd($catalogs['charges']);

        $employees = User::with($relationships)
            ->orderBy('lastname', 'asc')
            ->orderBy('firstname', 'asc')
            ->where('usertype', 4)
            ->where('charge', '!=', 10)
            ->get();

        return Inertia::render('humanResources/users/employees', [
            'employees' => $employees,
            'catalogs' => $catalogs,
        ]);
    }

    // public function updateEmployees(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     // 1. Validación de datos
    //     // Usamos 'nullable' para permitir que los campos opcionales vengan vacíos o nulos
    //     $validated = $request->validate([
    //         // Identificación y Usuario
    //         'firstname' => 'required|string|max:25',
    //         'lastname' => 'required|string|max:25',
    //         'secondname' => 'nullable|string|max:25',
    //         'motherslastname' => 'nullable|string|max:25',
    //         'username' => 'required|string|max:25|unique:users,username,' . $id,
    //         'email' => 'required|email|max:255|unique:users,email,' . $id,
    //         'identificationcard' => 'required|string|max:255|unique:users,identificationcard,' . $id,
    //         'user_status' => 'required|string',

    //         // Llaves foráneas (Foreign Keys)
    //         // Validamos que existan en sus respectivas tablas si se envía un valor
    //         'identification' => 'nullable|exists:identifications,id',
    //         'city' => 'nullable|exists:cities,id',
    //         'country' => 'nullable|exists:countries,id',
    //         'department' => 'nullable|exists:provinces,id', // Frontend envía 'department', DB espera 'department' (ID de provincia)
    //         'charge' => 'nullable|exists:charges,id',
    //         'work_area' => 'nullable|exists:work_areas,id',
    //         'civil_status' => 'nullable|exists:marital_statuses,id',
    //         'usertype' => 'nullable|exists:user_types,id',
    //         'bonding' => 'nullable|exists:bondings,id', // Frontend 'bonding' -> DB 'bonding_type'
    //         'eps' => 'nullable|exists:health_entities,id',
    //         'arl' => 'nullable|exists:arls,id',
    //         'pension' => 'nullable|exists:pensions,id',
    //         'layoffs' => 'nullable|exists:layoffs,id',
    //         'compensationbox' => 'nullable|exists:compensation_boxes,id',
    //         'branch' => 'nullable|exists:branches,id',
    //         'cityBirth' => 'nullable|exists:cities,id',      // Frontend 'cityBirth' -> DB 'city_birth'
    //         'educationLevel' => 'nullable|exists:educational_levels,id', // Frontend 'educationLevel' -> DB 'education_level'
    //         'relationship' => 'nullable|exists:relationships,id',
    //         'shoeSize' => 'nullable|exists:shoe_sizes,id',    // Frontend 'shoeSize' -> DB 'shoe_size'
    //         'bloodType' => 'nullable|exists:blood_types,id',  // Frontend 'bloodType' -> DB 'blood_type'

    //         // Fechas (nullable|date)
    //         'birthdate' => 'nullable|date',
    //         'user_entry_date' => 'nullable|date',
    //         'date_refund' => 'nullable|date',
    //         'date_eps' => 'nullable|date',
    //         'arl_date' => 'nullable|date',
    //         'date_pension' => 'nullable|date',
    //         'date_layoffs' => 'nullable|date',
    //         'date_compensationbox' => 'nullable|date',
    //         'study_end_date' => 'nullable|date',
    //         'start_date_last_company' => 'nullable|date',
    //         'date_end_last_company' => 'nullable|date',

    //         // Numéricos y Textos Varios
    //         'salary' => 'nullable|numeric',
    //         'aid_transport' => 'nullable|numeric',
    //         'weight' => 'nullable|numeric',
    //         'pant_size' => 'nullable|numeric',
    //         'address' => 'nullable|string|max:255',
    //         'phone' => 'nullable|string|max:255',
    //         'phone_cellular' => 'nullable|string|max:255',
    //         'type_sex' => 'nullable|string|in:F,M',
    //         'functions_performed' => 'nullable|string',
    //         'shirt_size' => 'nullable|string|max:10',
    //         'educational_institution' => 'nullable|string|max:150',
    //         'obtained_title' => 'nullable|string|max:255',
    //         'last_course' => 'nullable|string|max:255',

    //         // Datos familiares
    //         'family_names' => 'nullable|string|max:255',
    //         'family_address' => 'nullable|string|max:150',
    //         'family_phone' => 'nullable|string|max:255',
    //         'family_phone_cellular' => 'nullable|string|max:255',
    //         'identificationcard_family' => 'nullable|string|max:255',
    //         'family_document_type' => 'nullable|exists:identifications,id',
    //         'place_expedition_identificationcard' => 'nullable|string|max:255',

    //         // Experiencia
    //         'last_company_name' => 'nullable|string|max:150',
    //         'charges_last_company' => 'nullable|string|max:255',
    //         'code_company' => 'nullable|string|max:255',
    //     ]);

    //     // 2. Mapeo de nombres del Frontend a columnas de la Base de Datos
    //     // El frontend envía camelCase pero tu SQL usa snake_case o nombres ligeramente distintos

    //     $dataToUpdate = collect($validated)
    //         // Filtramos los valores vacíos '' para convertirlos a NULL (Postgres falla si insertas '' en un integer)
    //         ->map(function ($value) {
    //             return $value === '' ? null : $value;
    //         })
    //         ->toArray();

    //     // Asignaciones manuales para corregir discrepancias de nombres
    //     $dataToUpdate['bonding_type'] = $dataToUpdate['bonding'] ?? null;
    //     $dataToUpdate['city_birth'] = $dataToUpdate['cityBirth'] ?? null;
    //     $dataToUpdate['education_level'] = $dataToUpdate['educationLevel'] ?? null;
    //     $dataToUpdate['shoe_size'] = $dataToUpdate['shoeSize'] ?? null;
    //     $dataToUpdate['blood_type'] = $dataToUpdate['bloodType'] ?? null;

    //     // Eliminamos las llaves antiguas del array para que no den error de "columna no existe"
    //     unset(
    //         $dataToUpdate['bonding'],
    //         $dataToUpdate['cityBirth'],
    //         $dataToUpdate['educationLevel'],
    //         $dataToUpdate['shoeSize'],
    //         $dataToUpdate['bloodType']
    //     );

    //     // 3. Actualizar
    //     $user->update($dataToUpdate);

    //     // 4. Retornar con mensaje Flash (Inertia lo detectará)
    //     return back()->with('success', 'Información del empleado actualizada correctamente');
    // }

    public function updateEmployees(Request $request, User $user) // CAMBIO: Usamos inyección de modelo (User $user)
    {
        // ID real para la validación unique
        $id = $user->id;

        // 1. Validación
        $validated = $request->validate([
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:25',
            'secondname' => 'nullable|string|max:25',
            'motherslastname' => 'nullable|string|max:25',
            // VALIDACIÓN CORREGIDA: Usamos $id extraído correctamente
            // 'username' => 'required|string|max:25|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'identificationcard' => 'required|string|max:255|unique:users,identificationcard,' . $id,
            'user_status' => 'required|string',

            // Validación de Foreign Keys (Frontend Names)
            'branch' => 'nullable|exists:branches,id',
            'cityBirth' => 'nullable|exists:cities,id',
            'educationLevel' => 'nullable|exists:educational_levels,id',
            'shoeSize' => 'nullable|exists:shoe_sizes,id',
            'bloodType' => 'nullable|exists:blood_types,id',
            'bonding' => 'nullable|exists:bondings,id',

            // ... (Resto de tus validaciones de identification, city, country, etc. Déjalas igual) ...
            'identification' => 'nullable|exists:identifications,id',
            'city' => 'nullable|exists:cities,id',
            'country' => 'nullable|exists:countries,id',
            'department' => 'nullable|exists:provinces,id', // Frontend manda 'department'
            'charge' => 'nullable|exists:charges,id',
            'work_area' => 'nullable|exists:work_areas,id',
            'civil_status' => 'nullable|exists:marital_statuses,id',
            'usertype' => 'nullable|exists:user_types,id',
            'eps' => 'nullable|exists:health_entities,id',
            'arl' => 'nullable|exists:arls,id',
            'pension' => 'nullable|exists:pensions,id',
            'layoffs' => 'nullable|exists:layoffs,id',
            'compensationbox' => 'nullable|exists:compensation_boxes,id',
            'relationship' => 'nullable|exists:relationships,id',

            // Fechas y Textos
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'phone_cellular' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'aid_transport' => 'nullable|numeric',
            'birthdate' => 'nullable|date',
            'user_entry_date' => 'nullable|date',
            'type_sex' => 'nullable|string',
            'functions_performed' => 'nullable|string',

            // ... resto de fechas ...
        ]);

        // 2. Limpieza y Mapeo (CRÍTICO)
        $dataToUpdate = collect($validated)
            ->map(function ($value) {
                return $value === '' ? null : $value;
            })
            ->toArray();

        // 3. Corregir nombres de columnas (Frontend -> Base de Datos)
        // El frontend envía 'branch', la BD espera 'branch_id'
        if (array_key_exists('branch', $dataToUpdate)) {
            $dataToUpdate['branch_id'] = $dataToUpdate['branch'];
            unset($dataToUpdate['branch']);
        }

        // Mapeo bonding -> bonding_type
        if (array_key_exists('bonding', $dataToUpdate)) {
            $dataToUpdate['bonding_type'] = $dataToUpdate['bonding'];
            unset($dataToUpdate['bonding']);
        }

        // Mapeo cityBirth -> city_birth
        if (array_key_exists('cityBirth', $dataToUpdate)) {
            $dataToUpdate['city_birth'] = $dataToUpdate['cityBirth'];
            unset($dataToUpdate['cityBirth']);
        }

        // Mapeo educationLevel -> education_level
        if (array_key_exists('educationLevel', $dataToUpdate)) {
            $dataToUpdate['education_level'] = $dataToUpdate['educationLevel'];
            unset($dataToUpdate['educationLevel']);
        }

        // Mapeo shoeSize -> shoe_size
        if (array_key_exists('shoeSize', $dataToUpdate)) {
            $dataToUpdate['shoe_size'] = $dataToUpdate['shoeSize'];
            unset($dataToUpdate['shoeSize']);
        }

        // Mapeo bloodType -> blood_type
        if (array_key_exists('bloodType', $dataToUpdate)) {
            $dataToUpdate['blood_type'] = $dataToUpdate['bloodType'];
            unset($dataToUpdate['bloodType']);
        }

        // Mapeo department -> department (Si en la BD se llama diferente, cámbialo aquí. 
        // Según tu SQL de Users, es 'department bigint', así que está bien, pero el select se llama department).

        try {
            $user->update($dataToUpdate);
            return back()->with('success', 'Información actualizada correctamente');
        } catch (\Exception $e) {
            // Esto nos ayudará a ver el error real si falla SQL
            return back()->withErrors(['sql_error' => 'Error de base de datos: ' . $e->getMessage()]);
        }
    }
}
