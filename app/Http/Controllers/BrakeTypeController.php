<?php

namespace App\Http\Controllers;

use App\Models\BrakeType;
use App\Http\Requests\StoreBrakeTypeRequest;
use App\Http\Requests\UpdateBrakeTypeRequest;

class BrakeTypeController extends Controller
{
    public function store(StoreBrakeTypeRequest $request)
    {
        BrakeType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de freno creado correctamente.');
    }

    public function update(UpdateBrakeTypeRequest $request, BrakeType $brakeType)
    {
        $brakeType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de freno actualizado correctamente.');
    }

    public function destroy(BrakeType $brakeType)
    {
        $brakeType->delete();
        return redirect()->back()->with('success', 'Tipo de freno eliminado correctamente.');
    }

}
