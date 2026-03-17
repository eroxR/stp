<?php

namespace App\Http\Controllers;

use App\Models\DimensionRim;
use App\Http\Requests\StoreDimensionRimRequest;
use App\Http\Requests\UpdateDimensionRimRequest;

class DimensionRimController extends Controller
{
    public function store(StoreDimensionRimRequest $request)
    {
        DimensionRim::create($request->validated());
        return redirect()->back()->with('success', 'Dimensión de rin creada correctamente.');
    }

    public function update(UpdateDimensionRimRequest $request, DimensionRim $dimensionRim)
    {
        $dimensionRim->update($request->validated());
        return redirect()->back()->with('success', 'Dimensión de rin actualizada correctamente.');
    }

    public function destroy(DimensionRim $dimensionRim)
    {
        $dimensionRim->delete();
        return redirect()->back()->with('success', 'Dimensión de rin eliminada correctamente.');
    }

}
