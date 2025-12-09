import { DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/react';

// Datos de ejemplo. En el futuro, esto vendría de las props de Inertia.
const notifications = [
    {
        id: 1,
        title: 'Nueva Actualización',
        description: 'La versión 1.2.0 ya está disponible.',
        read: false,
    },
    {
        id: 2,
        title: 'Mantenimiento Programado',
        description: 'El sistema estará en mantenimiento el día 30.',
        read: false,
    },
    {
        id: 3,
        title: 'Contraseña Actualizada',
        description: 'Tu contraseña fue cambiada exitosamente.',
        read: true,
    },
];

export function NotificationsMenuContent() {
    return (
        <>
            <DropdownMenuLabel className="px-4 py-2">Notificaciones</DropdownMenuLabel>
            <DropdownMenuSeparator />

            <div className="flex flex-col">
                {notifications.length > 0 ? (
                    notifications.map((notification) => (
                        <DropdownMenuItem key={notification.id} className="flex flex-col items-start gap-1 p-3">
                            <div className="flex items-center gap-2">
                                {!notification.read && <div className="h-2 w-2 rounded-full bg-blue-500" />}
                                <p className="font-semibold">{notification.title}</p>
                            </div>
                            <p className="pl-4 text-xs text-muted-foreground">{notification.description}</p>
                        </DropdownMenuItem>
                    ))
                ) : (
                    <p className="p-4 text-sm text-muted-foreground">No tienes notificaciones nuevas.</p>
                )}
            </div>

            <DropdownMenuSeparator />
            <DropdownMenuItem asChild>
                <Link href="#" className="flex cursor-pointer items-center justify-center p-2">
                    Ver todas las notificaciones
                </Link>
            </DropdownMenuItem>
        </>
    );
}
