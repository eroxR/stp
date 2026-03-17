<?php

namespace App\Http\Controllers;

use App\Models\InspectionCategory;
use App\Http\Requests\StoreInspectionCategoryRequest;
use App\Http\Requests\UpdateInspectionCategoryRequest;

class InspectionCategoryController extends Controller
{
    public function store(StoreInspectionCategoryRequest $request)
    {
        InspectionCategory::create($request->validated());
        return redirect()->back()->with('success', 'Categoría de inspección creada correctamente.');
    }

    public function update(UpdateInspectionCategoryRequest $request, InspectionCategory $inspectionCategory)
    {
        // Nota: Laravel resolverá el modelo si la ruta usa {inspectionCategory}
        $inspectionCategory->update($request->validated());
        return redirect()->back()->with('success', 'Categoría de inspección actualizada correctamente.');
    }

    public function destroy(InspectionCategory $inspectionCategory)
    {
        $inspectionCategory->delete();
        return redirect()->back()->with('success', 'Categoría de inspección eliminada correctamente.');
    }

}
