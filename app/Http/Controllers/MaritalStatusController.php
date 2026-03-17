<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Http\Requests\StoreMaritalStatusRequest;
use App\Http\Requests\UpdateMaritalStatusRequest;

class MaritalStatusController extends Controller
{
    public function store(StoreMaritalStatusRequest $request)
    {
        MaritalStatus::create($request->validated());
        return redirect()->back()->with('success', 'Estado civil creado correctamente.');
    }

    public function update(UpdateMaritalStatusRequest $request, MaritalStatus $maritalStatus)
    {
        $maritalStatus->update($request->validated());
        return redirect()->back()->with('success', 'Estado civil actualizado correctamente.');
    }

    public function destroy(MaritalStatus $maritalStatus)
    {
        $maritalStatus->delete();
        return redirect()->back()->with('success', 'Estado civil eliminado correctamente.');
    }

}
