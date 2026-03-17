<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Http\Requests\StoreBloodTypeRequest;
use App\Http\Requests\UpdateBloodTypeRequest;

class BloodTypeController extends Controller
{
    public function store(StoreBloodTypeRequest $request)
    {
        BloodType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de sangre creado correctamente.');
    }

    public function update(UpdateBloodTypeRequest $request, BloodType $bloodType)
    {
        $bloodType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de sangre actualizado correctamente.');
    }

    public function destroy(BloodType $bloodType)
    {
        $bloodType->delete();
        return redirect()->back()->with('success', 'Tipo de sangre eliminado correctamente.');
    }

}
