<?php

namespace App\Http\Controllers;

use App\Models\SupplierCategory;
use App\Http\Requests\StoreSupplierCategoryRequest;
use App\Http\Requests\UpdateSupplierCategoryRequest;

class SupplierCategoryController extends Controller
{
    public function store(StoreSupplierCategoryRequest $request)
    {
        SupplierCategory::create($request->validated());
        return redirect()->back()->with('success', 'Categoría de proveedor creada correctamente.');
    }

    public function update(UpdateSupplierCategoryRequest $request, SupplierCategory $supplierCategory)
    {
        $supplierCategory->update($request->validated());
        return redirect()->back()->with('success', 'Categoría de proveedor actualizada correctamente.');
    }

    public function destroy(SupplierCategory $supplierCategory)
    {
        // Opcional: Validar si tiene productos asociados
        // if($supplierCategory->productsAndServices()->exists()) {
        //     return back()->with('error', 'No se puede eliminar: tiene productos asociados.');
        // }

        $supplierCategory->delete();
        return redirect()->back()->with('success', 'Categoría de proveedor eliminada correctamente.');
    }

}
