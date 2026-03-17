<?php

namespace App\Http\Controllers;

use App\Models\EconomicActivityCategory;
use App\Http\Requests\StoreEconomicActivityCategoryRequest;
use App\Http\Requests\UpdateEconomicActivityCategoryRequest;

class EconomicActivityCategoryController extends Controller
{
    public function store(StoreEconomicActivityCategoryRequest $request)
    {
        EconomicActivityCategory::create($request->validated());
        return redirect()->back()->with('success', 'Categoría creada correctamente.');
    }

    public function update(UpdateEconomicActivityCategoryRequest $request, EconomicActivityCategory $category)
    {
        // Nota: Laravel inyecta el modelo basándose en el nombre de la ruta.
        // En web.php definiremos el parámetro.
        $category->update($request->validated());
        return redirect()->back()->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(EconomicActivityCategory $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Categoría eliminada correctamente.');
    }

}
