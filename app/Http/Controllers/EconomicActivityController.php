<?php

namespace App\Http\Controllers;

use App\Models\EconomicActivity;
use App\Http\Requests\StoreEconomicActivityRequest;
use App\Http\Requests\UpdateEconomicActivityRequest;

class EconomicActivityController extends Controller
{
    public function store(StoreEconomicActivityRequest $request)
    {
        EconomicActivity::create($request->validated());
        return redirect()->back()->with('success', 'Actividad económica creada correctamente.');
    }

    public function update(UpdateEconomicActivityRequest $request, EconomicActivity $economicActivity)
    {
        $economicActivity->update($request->validated());
        return redirect()->back()->with('success', 'Actividad económica actualizada correctamente.');
    }

    public function destroy(EconomicActivity $economicActivity)
    {
        $economicActivity->delete();
        return redirect()->back()->with('success', 'Actividad económica eliminada correctamente.');
    }

}
