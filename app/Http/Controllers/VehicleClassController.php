<?php

namespace App\Http\Controllers;

use App\Models\VehicleClass;
use App\Http\Requests\StoreVehicleClassRequest;
use App\Http\Requests\UpdateVehicleClassRequest;

class VehicleClassController extends Controller
{
    public function store(StoreVehicleClassRequest $request)
    {
        VehicleClass::create($request->validated());
        return redirect()->back()->with('success', 'Clase de vehículo creada correctamente.');
    }

    public function update(UpdateVehicleClassRequest $request, VehicleClass $vehicleClass)
    {
        $vehicleClass->update($request->validated());
        return redirect()->back()->with('success', 'Clase de vehículo actualizada correctamente.');
    }

    public function destroy(VehicleClass $vehicleClass)
    {
        $vehicleClass->delete();
        return redirect()->back()->with('success', 'Clase de vehículo eliminada correctamente.');
    }
 
}
