<?php

namespace App\Http\Controllers;

use App\Models\AlertStatus;
use App\Http\Requests\StoreAlertStatusRequest;
use App\Http\Requests\UpdateAlertStatusRequest;

class AlertStatusController extends Controller
{
    public function store(StoreAlertStatusRequest $request)
    {
        AlertStatus::create($request->validated());
        return redirect()->back()->with('success', 'Estado de alerta creado correctamente.');
    }

    public function update(UpdateAlertStatusRequest $request, AlertStatus $alertStatus)
    {
        $alertStatus->update($request->validated());
        return redirect()->back()->with('success', 'Estado de alerta actualizado correctamente.');
    }

    public function destroy(AlertStatus $alertStatus)
    {
        $alertStatus->delete();
        return redirect()->back()->with('success', 'Estado de alerta eliminado correctamente.');
    }
}
