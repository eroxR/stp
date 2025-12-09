<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\City;
use App\Models\EconomicActivity;
use App\Models\Identification;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Obtener la empresa del usuario logueado
        $company = Company::where('code_company', $user->code_company)->first();

        // 2. Obtener el término de búsqueda
        $searchActivity = $request->input('search_activity');
        $currentActivityCode = $company->economic_activity_code;

        // 3. Iniciar la consulta
        $economicActivitiesQuery = EconomicActivity::select('economicactivity_number', 'description_economicactivity');

        // 4. APLICAR FILTRO DE BÚSQUEDA (Case-Insensitive)
        $economicActivitiesQuery->when($searchActivity, function ($query, $searchTerm) {
            // CORRECCIÓN DEL ERROR: Usamos $searchTerm en lugar de $search.
            $lowerSearch = strtolower($searchTerm);
            $query->where(DB::raw('LOWER(economicactivity_number)'), 'like', "%{$lowerSearch}%")
                ->orWhere(DB::raw('LOWER(description_economicactivity)'), 'like', "%{$lowerSearch}%");
        });

        // 5. SOLUCIÓN PROBLEMA 1: Asegurar que la actividad actual esté SIEMPRE en la lista.
        // Hacemos un whereRaw si no hay búsqueda, o un orWhere si sí la hay.
        if (!$searchActivity && $currentActivityCode) {
            // Si no hay búsqueda, devolvemos la actividad actual o un conjunto vacío
            $economicActivitiesQuery->where('economicactivity_number', $currentActivityCode);
        } elseif ($searchActivity && $currentActivityCode) {
            // Si hay búsqueda, agregamos la actividad actual a los resultados con orWhere
            $economicActivitiesQuery->orWhere('economicactivity_number', $currentActivityCode);
        }

        // 6. Finalizar la consulta
        $economicActivities = $economicActivitiesQuery
            ->orderBy('description_economicactivity')
            ->limit(50)
            ->get()
            ->map(function ($activity) {
                return [
                    'value' => $activity->economicactivity_number,
                    'label' => $activity->description_economicactivity,
                ];
            });

        $identifications = Identification::where('visibility', '1') // Asumo que '1' es string por tu foto
            ->orderBy('description_identification')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => (string) $item->id, // Castear a string es importante para el select
                    'label' => $item->description_identification,
                ];
            });


        $provinces = Province::where('visibility', '1') // Asumo que '1' es string por tu foto
            ->orderBy('department_name')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => (string) $item->id, // Castear a string es importante para el select
                    'label' => $item->department_name,
                ];
            });


        $cities = City::where('visibility', '1') // Asumo que '1' es string por tu foto
            ->orderBy('city_name')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => (string) $item->id, // Castear a string es importante para el select
                    'label' => $item->city_name,
                ];
            });
        return Inertia::render('settings/company-info', [
            'company' => $company,
            'economicActivities' => $economicActivities,
            'identifications' => $identifications,
            'provinces' => $provinces,
            'cities' => $cities,
            'filters' => ['search_activity' => $searchActivity],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $company = Company::where('code_company', $user->code_company)->firstOrFail();

        // Use the global request() helper to ensure the request instance is available
        $validated = request()->validate([
            'name_company' => 'required|string|max:255',
            'nit_company' => 'required|string|max:255|unique:companies,nit_company,' . $company->id,
            'acronym_company' => 'nullable|string|max:255',
            'economic_activity_code' => 'required|string|exists:economic_activities,economicactivity_number',
            'legal_representative' => 'nullable|string|max:255',
            'legal_representative_identification' => 'nullable|string|max:255',
            'legal_representative_document' => 'nullable|string|max:255',
            'legal_representative_expedition_identificationcard' => 'nullable|string|max:255',
            'address_representative_legal' => 'nullable|string|max:255',
            'phone_representative_legal' => 'nullable|string|max:255',
            'email_representative_legal' => 'nullable|email|max:255',
            'digital_signature_legal_representative' => 'nullable|string|max:255',
            'legal_nature' => 'nullable|string|max:255',
            'address_company' => 'nullable|string|max:255',
            'phone_company' => 'nullable|string|max:255',
            'email_company' => 'nullable|email|max:255',
            'website_company' => 'nullable|string|max:255',
            'scope_company' => 'nullable|string|max:255',
            'description_company' => 'nullable|string',
            'country_company' => 'nullable|string|max:255',
            'province_company' => 'nullable|string|max:255',
            'city_company' => 'nullable|string|max:255',
            'mission_company' => 'nullable|string',
            'vision_company' => 'nullable|string',
            'values_company' => 'nullable|string',
            'postal_code_company' => 'nullable|string|max:255',
            'number_employees' => 'nullable|integer',
            'number_branches' => 'nullable|integer',
        ]);

        $company->update($validated);

        return back()->with('success', 'Información de la empresa actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
