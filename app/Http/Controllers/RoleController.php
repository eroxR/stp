<?php

namespace App\Http\Controllers;

use App\Models\Role; // <--- USAR TU MODELO LOCAL
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());
        return redirect()->back()->with('success', 'Rol creado correctamente.');
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->back()->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        // Opcional: Evitar borrar roles con permisos o usuarios
        // if ($role->users()->count() > 0) {
        //     return redirect()->back()->with('error', 'No se puede eliminar un rol asignado a usuarios.');
        // }

        $role->delete();
        return redirect()->back()->with('success', 'Rol eliminado correctamente.');
    }

}
