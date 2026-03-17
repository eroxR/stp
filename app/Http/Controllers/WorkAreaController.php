<?php

namespace App\Http\Controllers;

use App\Models\WorkArea;
use App\Http\Requests\StoreWorkAreaRequest;
use App\Http\Requests\UpdateWorkAreaRequest;

class WorkAreaController extends Controller
{
    public function store(StoreWorkAreaRequest $request)
    {
        WorkArea::create($request->validated());
        return redirect()->back()->with('success', 'Área de trabajo creada correctamente.');
    }

    public function update(UpdateWorkAreaRequest $request, WorkArea $workArea)
    {
        $workArea->update($request->validated());
        return redirect()->back()->with('success', 'Área de trabajo actualizada correctamente.');
    }

    public function destroy(WorkArea $workArea)
    {
        // Opcional: Validar si tiene cargos asociados antes de borrar
        // if($workArea->charges()->exists()) {
        //    return redirect()->back()->with('error', 'No se puede eliminar el área porque tiene cargos asociados.');
        // }

        $workArea->delete();
        return redirect()->back()->with('success', 'Área de trabajo eliminada correctamente.');
    }

}
