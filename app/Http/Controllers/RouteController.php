<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function store(StoreRouteRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        // Inyección de datos de empresa (ajusta los defaults según tu lógica)
        $data['company_id'] = $user->company_id ?? 1;
        $data['branch_id'] = $user->branch_id ?? 1;
        $data['code_company'] = $user->company->code ?? 'DEF';

        Route::create($data);
        return redirect()->back()->with('success', 'Ruta creada correctamente.');
    }

    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route->update($request->validated());
        return redirect()->back()->with('success', 'Ruta actualizada correctamente.');
    }

    public function destroy(Route $route)
    {
        // Opcional: Validar si está en uso en contratos
        // if($route->contractsOrigin()->exists() || $route->contractsDestination()->exists()) { ... }

        $route->delete();
        return redirect()->back()->with('success', 'Ruta eliminada correctamente.');
    }

}
