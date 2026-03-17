<?php

namespace App\Http\Controllers;

use App\Models\productAndService;
use App\Http\Requests\StoreproductAndServiceRequest;
use App\Http\Requests\UpdateproductAndServiceRequest;

class ProductAndServiceController extends Controller
{
    public function store(StoreProductAndServiceRequest $request)
    {
        ProductAndService::create($request->validated());
        return redirect()->back()->with('success', 'Producto/Servicio creado correctamente.');
    }

    public function update(UpdateProductAndServiceRequest $request, ProductAndService $productAndService)
    {
        // Importante: Asegúrate que el parámetro de la ruta coincida con $productAndService
        $productAndService->update($request->validated());
        return redirect()->back()->with('success', 'Producto/Servicio actualizado correctamente.');
    }

    public function destroy(ProductAndService $productAndService)
    {
        $productAndService->delete();
        return redirect()->back()->with('success', 'Producto/Servicio eliminado correctamente.');
    }

}
