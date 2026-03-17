<?php

namespace App\Http\Controllers;

use App\Models\FuelType;
use App\Http\Requests\StoreFuelTypeRequest;
use App\Http\Requests\UpdateFuelTypeRequest;

class FuelTypeController extends Controller
{
    public function store(StoreFuelTypeRequest $request)
    {
        FuelType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de combustible creado correctamente.');
    }

    public function update(UpdateFuelTypeRequest $request, FuelType $fuelType)
    {
        $fuelType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de combustible actualizado correctamente.');
    }

    public function destroy(FuelType $fuelType)
    {
        $fuelType->delete();
        return redirect()->back()->with('success', 'Tipo de combustible eliminado correctamente.');
    }
 
}
