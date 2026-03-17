<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrand;
use App\Http\Requests\StoreVehicleBrandRequest;
use App\Http\Requests\UpdateVehicleBrandRequest;

class VehicleBrandController extends Controller
{
    public function store(StoreVehicleBrandRequest $request)
    {
        VehicleBrand::create($request->validated());
        return redirect()->back()->with('success', 'Marca de vehículo creada correctamente.');
    }

    public function update(UpdateVehicleBrandRequest $request, VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->update($request->validated());
        return redirect()->back()->with('success', 'Marca de vehículo actualizada correctamente.');
    }

    public function destroy(VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->delete();
        return redirect()->back()->with('success', 'Marca de vehículo eliminada correctamente.');
    }

}
