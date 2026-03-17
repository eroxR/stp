<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateInspectionRequest;

class InspectionController extends Controller
{
    public function store(StoreInspectionRequest $request)
    {
        Inspection::create($request->validated());
        return redirect()->back()->with('success', 'Inspección creada correctamente.');
    }

    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection->update($request->validated());
        return redirect()->back()->with('success', 'Inspección actualizada correctamente.');
    }

    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
        return redirect()->back()->with('success', 'Inspección eliminada correctamente.');
    }

}
