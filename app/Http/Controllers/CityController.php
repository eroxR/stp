<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    public function store(StoreCityRequest $request)
    {
        City::create($request->validated());
        return redirect()->back()->with('success', 'Ciudad creada correctamente.');
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        return redirect()->back()->with('success', 'Ciudad actualizada correctamente.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->back()->with('success', 'Ciudad eliminada correctamente.');
    }

}
