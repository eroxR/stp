<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;

class ChargeController extends Controller
{
    public function store(StoreChargeRequest $request)
    {
        Charge::create($request->validated());
        return redirect()->back()->with('success', 'Cargo creado correctamente.');
    }

    public function update(UpdateChargeRequest $request, Charge $charge)
    {
        $charge->update($request->validated());
        return redirect()->back()->with('success', 'Cargo actualizado correctamente.');
    }

    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect()->back()->with('success', 'Cargo eliminado correctamente.');
    }

}
