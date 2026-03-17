<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;

class ProvinceController extends Controller
{
    public function store(StoreProvinceRequest $request)
    {
        Province::create($request->validated());
        return redirect()->back()->with('success', 'Departamento creado correctamente.');
    }

    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());
        return redirect()->back()->with('success', 'Departamento actualizado correctamente.');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->back()->with('success', 'Departamento eliminado correctamente.');
    }

}
