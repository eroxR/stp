<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        return redirect()->back()->with('success', 'País creado correctamente.');
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        return redirect()->back()->with('success', 'País actualizado correctamente.');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->back()->with('success', 'País eliminado correctamente.');
    }

}
