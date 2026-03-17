<?php

namespace App\Http\Controllers;

use App\Models\ShoeSize;
use App\Http\Requests\StoreShoeSizeRequest;
use App\Http\Requests\UpdateShoeSizeRequest;

class ShoeSizeController extends Controller
{
    public function store(StoreShoeSizeRequest $request)
    {
        ShoeSize::create($request->validated());
        return redirect()->back()->with('success', 'Talla de zapato creada correctamente.');
    }

    public function update(UpdateShoeSizeRequest $request, ShoeSize $shoeSize)
    {
        $shoeSize->update($request->validated());
        return redirect()->back()->with('success', 'Talla de zapato actualizada correctamente.');
    }

    public function destroy(ShoeSize $shoeSize)
    {
        $shoeSize->delete();
        return redirect()->back()->with('success', 'Talla de zapato eliminada correctamente.');
    }

}
