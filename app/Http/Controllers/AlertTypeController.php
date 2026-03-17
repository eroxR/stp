<?php

namespace App\Http\Controllers;

use App\Models\AlertType;
use App\Http\Requests\StoreAlertTypeRequest;
use App\Http\Requests\UpdateAlertTypeRequest;

class AlertTypeController extends Controller
{
    public function store(StoreAlertTypeRequest $request)
    {
        AlertType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de alerta creado correctamente.');
    }

    public function update(UpdateAlertTypeRequest $request, AlertType $alertType)
    {
        $alertType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de alerta actualizado correctamente.');
    }

    public function destroy(AlertType $alertType)
    {
        $alertType->delete();
        return redirect()->back()->with('success', 'Tipo de alerta eliminado correctamente.');
    }

}
