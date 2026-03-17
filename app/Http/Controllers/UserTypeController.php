<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\Http\Requests\StoreUserTypeRequest;
use App\Http\Requests\UpdateUserTypeRequest;

class UserTypeController extends Controller
{
    public function store(StoreUserTypeRequest $request)
    {
        UserType::create($request->validated());
        return redirect()->back()->with('success', 'Tipo de usuario creado correctamente.');
    }

    public function update(UpdateUserTypeRequest $request, UserType $userType)
    {
        $userType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de usuario actualizado correctamente.');
    }

    public function destroy(UserType $userType)
    {
        $userType->delete();
        return redirect()->back()->with('success', 'Tipo de usuario eliminado correctamente.');
    }

}
