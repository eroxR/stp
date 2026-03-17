<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use App\Http\Requests\StoreIdentificationRequest;
use App\Http\Requests\UpdateIdentificationRequest;

class IdentificationController extends Controller
{
    public function store(StoreIdentificationRequest $request)
    {
        // El $request ya viene validado gracias a la clase StoreIdentificationRequest

        Identification::create($request->validated());

        // Retornamos atrás con un mensaje flash (Inertia lo maneja)
        return redirect()->back()->with('success', 'Registro creado correctamente.');
    }

    public function update(UpdateIdentificationRequest $request, Identification $identification)
    {
        // Actualizamos con los datos validados
        $identification->update($request->validated());

        return redirect()->back()->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Identification $identification)
    {
        $identification->delete();

        return redirect()->back()->with('success', 'Registro eliminado correctamente.');
    }

}
