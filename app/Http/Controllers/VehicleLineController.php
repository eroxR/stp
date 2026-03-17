<?php

namespace App\Http\Controllers;

use App\Models\VehicleLine;
use App\Http\Requests\StoreVehicleLineRequest;
use App\Http\Requests\UpdateVehicleLineRequest;

class VehicleLineController extends Controller
{
    public function store(StoreVehicleLineRequest $request)
    {
        VehicleLine::create($request->validated());
        return redirect()->back()->with('success', 'Línea vehicular creada correctamente.');
    }

    public function update(UpdateVehicleLineRequest $request, VehicleLine $vehicleLine)
    {
        $vehicleLine->update($request->validated());
        return redirect()->back()->with('success', 'Línea vehicular actualizada correctamente.');
    }

    public function destroy(VehicleLine $vehicleLine)
    {
        $vehicleLine->delete();
        return redirect()->back()->with('success', 'Línea vehicular eliminada correctamente.');
    }

}
