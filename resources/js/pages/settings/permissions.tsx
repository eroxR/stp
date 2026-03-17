import SidebarLayout, { MenuSection } from '@/components/sidebar-layout';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Switch } from '@/components/ui/switch';
import AppLayout from '@/layouts/app-layout';
import { MySwal } from '@/lib/swal';
import { Head, router } from '@inertiajs/react';
import { useEffect, useMemo, useState } from 'react';
import { useTranslation } from 'react-i18next';

interface Permission {
    id: string;
    name: string;
    label: string;
    guard_name: string;
}

interface RoleWithPermissions {
    id: string;
    name: string;
    guard_name: string;
    created_at: string | null;
    updated_at: string | null;
    assigned_permission_ids: string[];
}

interface RoleMenuItem {
    id: string;
    label: string;
    guard_name: string;
    permissions_count: number;
}

interface PermissionsProps {
    roles: RoleMenuItem[];
    rolesWithPermissions: RoleWithPermissions[];
    allPermissions: Permission[];
}

export default function Permissions({ roles, rolesWithPermissions, allPermissions }: PermissionsProps) {
    const { t } = useTranslation();
    const [activeMenuItem, setActiveMenuItem] = useState(roles[0]?.id || '');
    const [localAssignedIds, setLocalAssignedIds] = useState<string[]>([]);

    const versions = [
        { id: 'v1.0.1', label: 'v1.0.1', current: true },
        { id: 'v1.1.0-alpha', label: 'v1.1.0-alpha', current: false },
        { id: 'v2.0.0-beta1', label: 'v2.0.0-beta1', current: false },
    ];

    // Crear secciones del menú
    const menuSections: MenuSection[] = useMemo(() => {
        return [
            {
                // title: `Roles del Sistema (${roles.length})`,
                title: `Roles del Sistema (${roles.length})`,
                items: roles.map((role) => ({
                    id: role.id,
                    label: `${role.label} (${role.permissions_count})`,
                })),
            },
        ];
    }, [roles]);

    // Obtener el rol activo actual
    const activeRole = useMemo(() => {
        return rolesWithPermissions.find((r) => r.id === activeMenuItem);
    }, [activeMenuItem, rolesWithPermissions]);

    // Actualizar los IDs asignados localmente cuando cambia el rol activo
    useEffect(() => {
        if (activeRole) {
            setLocalAssignedIds(activeRole.assigned_permission_ids);
        }
    }, [activeRole]);

    // Verificar si un permiso está asignado
    const isPermissionAssigned = (permissionId: string) => {
        return localAssignedIds.includes(permissionId);
    };

    // Manejar el toggle de un permiso individual
    const handlePermissionToggle = (permissionId: string) => {
        if (!activeRole) return;

        const isCurrentlyAssigned = isPermissionAssigned(permissionId);

        // Actualizar optimísticamente el estado local
        if (isCurrentlyAssigned) {
            setLocalAssignedIds((prev) => prev.filter((id) => id !== permissionId));
        } else {
            setLocalAssignedIds((prev) => [...prev, permissionId]);
        }

        // Enviar al backend
        router.post(
            '/settings/permissions/toggle',
            {
                role_id: activeRole.id,
                permission_id: permissionId,
                assigned: !isCurrentlyAssigned,
            },
            {
                preserveState: true,
                preserveScroll: true,
                onError: () => {
                    // Revertir en caso de error
                    if (isCurrentlyAssigned) {
                        setLocalAssignedIds((prev) => [...prev, permissionId]);
                    } else {
                        setLocalAssignedIds((prev) => prev.filter((id) => id !== permissionId));
                    }
                },
            },
        );
    };

    // Asignar todos los permisos
    const handleAssignAll = () => {
        if (!activeRole) return;

        const allPermissionIds = allPermissions.map((p) => p.id);
        setLocalAssignedIds(allPermissionIds);

        router.post(
            '/settings/permissions/sync',
            {
                role_id: activeRole.id,
                permission_ids: allPermissionIds,
            },
            {
                preserveState: true,
                preserveScroll: true,
                onError: () => {
                    setLocalAssignedIds(activeRole.assigned_permission_ids);
                },
            },
        );
    };

    // Desasignar todos los permisos
    const handleRemoveAll = () => {
        if (!activeRole) return;

        MySwal.fire({
            title: '¿Estás seguro?',
            text: `Se removerán todos los permisos del rol "${activeRole.name}"`,
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Sí, remover todos',
            denyButtonText: 'No remover',
            customClass: {
                popup: 'swal-theme swal-remove-role',
                confirmButton: 'swal-green',
                denyButton: 'swal-red',
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                setLocalAssignedIds([]);

                router.post(
                    '/settings/permissions/sync',
                    {
                        role_id: activeRole.id,
                        permission_ids: [],
                    },
                    {
                        preserveState: true,
                        preserveScroll: true,
                        onSuccess: () => {
                            MySwal.fire({
                                icon: 'success',
                                title: 'Permisos removidos',
                                text: 'Todos los permisos han sido removidos exitosamente',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        },
                        onError: () => {
                            setLocalAssignedIds(activeRole.assigned_permission_ids);
                            MySwal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al remover los permisos',
                            });
                        },
                    },
                );
            }
        });
    };

    // Copiar permisos entre roles
    const handleCopyPermissions = () => {
        // Crear opciones para los selects
        const rolesOptions = rolesWithPermissions
            .map((role) => `<option value="${role.id}">${role.name} (${role.assigned_permission_ids.length} permisos)</option>`)
            .join('');

        MySwal.fire({
            title: 'Copiar Permisos',
            html: `
                <div class="space-y-4 text-left">
                    <div>
                        <label for="source-role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Copiar desde:
                        </label>
                        <select id="source-role" class="swal2-input w-full">
                            <option value="">Selecciona un rol origen</option>
                            ${rolesOptions}
                        </select>
                    </div>
                    <div>
                        <label for="target-role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Copiar a:
                        </label>
                        <select id="target-role" class="swal2-input w-full">
                            <option value="">Selecciona un rol destino</option>
                            ${rolesOptions}
                        </select>
                    </div>
                    <div class="mt-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <p class="text-xs text-blue-800 dark:text-blue-200">
                            <strong>Nota:</strong> Los permisos del rol destino serán reemplazados completamente por los del rol origen.
                        </p>
                    </div>
                </div>
            `,
            showDenyButton: true,
            confirmButtonText: 'Copiar Permisos',
            denyButtonText: 'No Copiar',
            focusConfirm: false,
            customClass: {
                popup: 'swal-theme swal-remove-role',
                confirmButton: 'swal2-confirm swal-green',
                denyButton: 'swal-red',
            },
            buttonsStyling: false,
            preConfirm: () => {
                const sourceRoleId = (document.getElementById('source-role') as HTMLSelectElement)?.value;
                const targetRoleId = (document.getElementById('target-role') as HTMLSelectElement)?.value;

                if (!sourceRoleId) {
                    MySwal.showValidationMessage('Debes seleccionar un rol origen');
                    return false;
                }

                if (!targetRoleId) {
                    MySwal.showValidationMessage('Debes seleccionar un rol destino');
                    return false;
                }

                if (sourceRoleId === targetRoleId) {
                    MySwal.showValidationMessage('Los roles origen y destino deben ser diferentes');
                    return false;
                }

                return { sourceRoleId, targetRoleId };
            },
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                const { sourceRoleId, targetRoleId } = result.value;

                const sourceRole = rolesWithPermissions.find((r) => r.id === sourceRoleId);
                const targetRole = rolesWithPermissions.find((r) => r.id === targetRoleId);

                // Mostrar confirmación adicional
                MySwal.fire({
                    title: '¿Confirmar copia?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Se copiarán <strong>${sourceRole?.assigned_permission_ids.length || 0} permisos</strong> desde:
                            </p>
                            <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 ml-2">
                                → ${sourceRole?.name}
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                                Hacia:
                            </p>
                            <p class="text-sm font-semibold text-green-600 dark:text-green-400 ml-2">
                                → ${targetRole?.name}
                            </p>
                            <p class="text-xs text-red-600 dark:text-red-400 mt-3">
                                Los permisos actuales de "${targetRole?.name}" serán reemplazados.
                            </p>
                        </div>
                    `,
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Sí, copiar',
                    denyButtonText: 'No Copiar',
                    customClass: {
                        popup: 'swal-theme swal-remove-role',
                        confirmButton: 'swal-green',
                        denyButton: 'swal-red',
                    },
                    buttonsStyling: false,
                }).then((confirmResult) => {
                    if (confirmResult.isConfirmed) {
                        router.post(
                            '/settings/permissions/copy',
                            {
                                source_role_id: sourceRoleId,
                                target_role_id: targetRoleId,
                            },
                            {
                                preserveState: true,
                                preserveScroll: true,
                                onSuccess: () => {
                                    MySwal.fire({
                                        icon: 'success',
                                        title: '¡Permisos copiados!',
                                        text: `Los permisos han sido copiados exitosamente de "${sourceRole?.name}" a "${targetRole?.name}"`,
                                        timer: 3000,
                                        showConfirmButton: false,
                                    });

                                    // Si el rol activo es el destino, actualizar la vista
                                    if (activeMenuItem === targetRoleId && sourceRole) {
                                        setLocalAssignedIds(sourceRole.assigned_permission_ids);
                                    }
                                },
                                onError: (errors) => {
                                    MySwal.fire({
                                        icon: 'error',
                                        title: 'Error al copiar',
                                        text: errors.message || 'Hubo un problema al copiar los permisos',
                                    });
                                },
                            },
                        );
                    }
                });
            }
        });
    };

    const renderContent = () => {
        if (!activeRole) {
            return (
                <div>
                    <h2 className="mb-4 text-2xl font-bold text-gray-800 dark:text-white">Selecciona un Rol</h2>
                    <p className="text-gray-600 dark:text-gray-300">Selecciona un rol del menú lateral para gestionar sus permisos.</p>
                </div>
            );
        }

        const assignedCount = localAssignedIds.length;
        const totalCount = allPermissions.length;

        return (
            <div className="space-y-6">
                {/* Header del Rol */}
                <div className="sticky top-0 z-20 space-y-4 border-b border-gray-200 bg-white px-6 pt-6 pb-4 shadow-md dark:border-gray-700 dark:bg-gray-900">
                    <div className="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 className="mb-2 text-xl font-bold text-gray-800 sm:text-2xl dark:text-white">{activeRole.name}</h2>
                            <p className="text-xs text-gray-600 sm:text-sm dark:text-gray-400">
                                Guard: {activeRole.guard_name} • {assignedCount} de {totalCount} permisos asignados
                            </p>
                        </div>
                        <div className="flex flex-col gap-2 sm:flex-row">
                            <Button variant="outline" size="sm" onClick={handleCopyPermissions} className="w-full sm:w-auto">
                                Copiar Permisos
                            </Button>
                            <Button
                                variant="outline"
                                size="sm"
                                onClick={handleAssignAll}
                                disabled={assignedCount === totalCount}
                                className="w-full sm:w-auto"
                            >
                                Asignar Todos
                            </Button>
                            <Button variant="outline" size="sm" onClick={handleRemoveAll} disabled={assignedCount === 0} className="w-full sm:w-auto">
                                Remover Todos
                            </Button>
                        </div>
                    </div>

                    {/* Información del Rol */}
                    <div className="rounded-lg border border-gray-200 bg-gray-50 p-3 sm:p-4 dark:border-gray-700 dark:bg-gray-800">
                        <h3 className="mb-2 text-xs font-semibold text-gray-700 sm:mb-3 sm:text-sm dark:text-gray-300">Información del Rol</h3>
                        <dl className="grid grid-cols-2 gap-4">
                            {/* <div>
                            <dt className="text-xs text-gray-600 dark:text-gray-400">ID:</dt>
                            <dd className="text-sm font-medium text-gray-900 dark:text-white">{activeRole.id}</dd>
                        </div> */}
                            <div>
                                <dt className="text-xs text-gray-600 dark:text-gray-400">Nombre:</dt>
                                <dd className="text-sm font-medium text-gray-900 dark:text-white">{activeRole.name}</dd>
                            </div>
                            {activeRole.created_at && (
                                <div>
                                    <dt className="text-xs text-gray-600 dark:text-gray-400">Creado:</dt>
                                    <dd className="text-sm font-medium text-gray-900 dark:text-white">
                                        {new Date(activeRole.created_at).toLocaleDateString()}
                                    </dd>
                                </div>
                            )}
                            {/* {activeRole.updated_at && (
                            <div>
                                <dt className="text-xs text-gray-600 dark:text-gray-400">Actualizado:</dt>
                                <dd className="text-sm font-medium text-gray-900 dark:text-white">
                                    {new Date(activeRole.updated_at).toLocaleDateString()}
                                </dd>
                            </div>
                        )} */}
                        </dl>
                    </div>
                </div>

                {/* Grid de Todos los Permisos */}
                <div>
                    <h3 className="mb-3 text-base font-semibold text-gray-800 sm:mb-4 sm:text-lg dark:text-white">Todos los Permisos del Sistema</h3>
                    <div className="grid gap-2 sm:grid-cols-2 sm:gap-3 lg:grid-cols-3">
                        {allPermissions.map((permission) => {
                            const isAssigned = isPermissionAssigned(permission.id);

                            return (
                                <div
                                    key={permission.id}
                                    className={`flex items-center justify-between rounded-lg border p-2 shadow-sm transition-all sm:p-4 ${
                                        isAssigned
                                            ? 'border-blue-300 bg-blue-50 dark:border-blue-700 dark:bg-blue-900/20'
                                            : 'border-gray-200 bg-white hover:border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600'
                                    }`}
                                >
                                    <div className="flex-1 pr-2 sm:pr-3">
                                        <Label
                                            htmlFor={`permission-${permission.id}`}
                                            className="cursor-pointer text-xs font-medium text-gray-900 sm:text-sm dark:text-white"
                                        >
                                            {permission.name}
                                        </Label>
                                        {/* <p className="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{permission.guard_name}</p> */}
                                        <p className="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                            Permiso que permite "Ingresar a la vista de Usuarios Empleados"
                                        </p>
                                    </div>
                                    <Switch
                                        id={`permission-${permission.id}`}
                                        checked={isAssigned}
                                        onCheckedChange={() => handlePermissionToggle(permission.id)}
                                    />
                                </div>
                            );
                        })}
                    </div>
                </div>
            </div>
        );
    };

    const handleSearch = (query: string) => {
        console.log('Buscando:', query);
        // Aquí puedes implementar la lógica de búsqueda
    };

    return (
        <AppLayout>
            <Head title={`${t('Permissions')}`} />
            <SidebarLayout
                title={`${t('Roles and Permissions')}`}
                version="datos"
                versions={versions}
                menuSections={menuSections}
                activeMenuItem={activeMenuItem}
                onMenuItemChange={setActiveMenuItem}
                searchPlaceholder={`${t('Search Permissions')}...`}
                onSearch={handleSearch}
            >
                {renderContent()}
            </SidebarLayout>
        </AppLayout>
    );
}
