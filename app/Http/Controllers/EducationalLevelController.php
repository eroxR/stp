<?php

namespace App\Http\Controllers;

use App\Models\EducationalLevel;
use App\Http\Requests\StoreEducationalLevelRequest;
use App\Http\Requests\UpdateEducationalLevelRequest;

class EducationalLevelController extends Controller
{
    public function store(StoreEducationalLevelRequest $request)
    {
        EducationalLevel::create($request->validated());
        return redirect()->back()->with('success', 'Nivel educativo creado correctamente.');
    }

    public function update(UpdateEducationalLevelRequest $request, EducationalLevel $educationalLevel)
    {
        $educationalLevel->update($request->validated());
        return redirect()->back()->with('success', 'Nivel educativo actualizado correctamente.');
    }

    public function destroy(EducationalLevel $educationalLevel)
    {
        $educationalLevel->delete();
        return redirect()->back()->with('success', 'Nivel educativo eliminado correctamente.');
    }

}
