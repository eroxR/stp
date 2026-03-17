<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateVehicleTypeRequest;

class VehicleTypeController extends Controller
{
    public function store(StoreVehicleTypeRequest $request)
    {
        VehicleType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de vehículo creado correctamente.');
    }

    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de vehículo actualizado correctamente.');
    }

    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();
        return redirect()->back()->with('success', 'Tipo de vehículo eliminado correctamente.');
    }

}
