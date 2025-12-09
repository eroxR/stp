<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function index()
    {
        // Obtener todos los roles
        $roles = Role::withCount('permissions')
            ->orderBy('name', 'asc')
            ->get();

        // Obtener todos los permisos disponibles en el sistema
        $allPermissions = Permission::orderBy('name', 'asc')->get();

        // Transformar los roles al formato que necesita el sidebar
        $menuItems = $roles->map(function ($role) {
            return [
                'id' => (string) $role->id,
                'label' => $role->name,
                'guard_name' => $role->guard_name,
                'permissions_count' => $role->permissions_count,
            ];
        });

        // Preparar los datos de cada rol con sus permisos asignados
        $rolesWithPermissions = $roles->map(function ($role) {
            return [
                'id' => (string) $role->id,
                'name' => $role->name,
                'guard_name' => $role->guard_name,
                'created_at' => $role->created_at?->format('Y-m-d H:i:s'),
                'updated_at' => $role->updated_at?->format('Y-m-d H:i:s'),
                // Solo los IDs de los permisos asignados
                'assigned_permission_ids' => $role->permissions->pluck('id')->map(fn($id) => (string) $id)->toArray(),
            ];
        });

        return Inertia::render('settings/permissions', [
            'roles' => $menuItems,
            'rolesWithPermissions' => $rolesWithPermissions,
            'allPermissions' => $allPermissions->map(function ($permission) {
                return [
                    'id' => (string) $permission->id,
                    'name' => $permission->name,
                    'guard_name' => $permission->guard_name,
                ];
            }),
        ]);
    }

    // Asignar o desasignar un permiso de un rol
    public function togglePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
            'assigned' => 'required|boolean',
        ]);

        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);

        if ($request->assigned) {
            // Asignar permiso (syncWithoutDetaching evita duplicados)
            $role->permissions()->syncWithoutDetaching([$permission->id]);
        } else {
            // Desasignar permiso
            $role->permissions()->detach($permission->id);
        }

        // Retornar el conteo actualizado
        $updatedRole = Role::withCount('permissions')->find($role->id);

        return back()->with([
            'success' => 'Permiso actualizado correctamente',
            'updatedRole' => [
                'id' => (string) $updatedRole->id,
                'permissions_count' => $updatedRole->permissions_count,
                'assigned_permission_ids' => $updatedRole->permissions->pluck('id')->map(fn($id) => (string) $id)->toArray(),
            ]
        ]);
    }

    // Asignar múltiples permisos a la vez
    public function syncPermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'array', // Permitir array vacío
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        // Sync acepta array vacío para remover todos los permisos
        $permissionIds = $request->input('permission_ids', []);
        $role->permissions()->sync($permissionIds);

        $updatedRole = Role::withCount('permissions')->find($role->id);

        return back()->with([
            'success' => count($permissionIds) > 0
                ? 'Permisos sincronizados correctamente'
                : 'Todos los permisos han sido removidos',
            'updatedRole' => [
                'id' => (string) $updatedRole->id,
                'permissions_count' => $updatedRole->permissions_count,
                'assigned_permission_ids' => $updatedRole->permissions->pluck('id')->map(fn($id) => (string) $id)->toArray(),
            ]
        ]);
    }

    // Copiar permisos de un rol a otro
    public function copyPermissions(Request $request)
    {
        $request->validate([
            'source_role_id' => 'required|exists:roles,id',
            'target_role_id' => 'required|exists:roles,id|different:source_role_id',
        ]);

        $sourceRole = Role::with('permissions')->findOrFail($request->source_role_id);
        $targetRole = Role::findOrFail($request->target_role_id);

        // Obtener los IDs de permisos del rol origen
        $permissionIds = $sourceRole->permissions->pluck('id')->toArray();

        // Sincronizar los permisos al rol destino
        $targetRole->permissions()->sync($permissionIds);

        return back()->with([
            'success' => "Permisos copiados exitosamente de '{$sourceRole->name}' a '{$targetRole->name}'",
        ]);
    }
}
