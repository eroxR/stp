import { Label } from '@/components/ui/label';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import { Switch } from '@/components/ui/switch';
import AppLayout from '@/layouts/app-layout';
import { MySwal } from '@/lib/swal';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, router, usePage } from '@inertiajs/react';
import { Eye, EyeOff } from 'lucide-react'; // <-- Los iconos que usaremos
import { useEffect } from 'react';
import { renderToString } from 'react-dom/server'; // <-- Para convertir iconos a string
import type { SweetAlertResult } from 'sweetalert2';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props;

    useEffect(() => {
        if (auth.user && auth.user.password_changed_at === null) {
            // --- 1. Convierte los iconos de React a strings de SVG ---
            const eyeIconSvg = renderToString(<Eye className="h-4 w-4" />);
            const eyeOffIconSvg = renderToString(<EyeOff className="h-4 w-4" />);
            MySwal.fire({
                title: 'Actualización Requerida',
                html: `
                    <p class="mb-4 text-sm text-muted-foreground">Por su seguridad, debe establecer una nueva contraseña para continuar.</p>
                    <div class="relative w-full">
                        <input type="password" id="password" class="swal2-input pr-10" placeholder="Nueva Contraseña">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            ${eyeIconSvg}
                        </button>
                    </div>
                    <div class="relative w-full">
                        <input type="password" id="password_confirmation" class="swal2-input pr-10" placeholder="Confirmar Contraseña">
                        <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            ${eyeIconSvg}
                        </button>
                    </div>
                `,
                confirmButtonText: 'Guardar Contraseña',
                focusConfirm: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showLoaderOnConfirm: true,
                customClass: {
                    // Mantenemos la clase de tema general para el popup...
                    popup: 'swal-theme',
                    // ... ¡Y añadimos nuestra clase específica solo para el botón de confirmar!
                    confirmButton: 'swal2-confirm swal-green',
                },
                buttonsStyling: false,
                didOpen: () => {
                    const togglePasswordBtn = document.getElementById('togglePassword');
                    const passwordInput = document.getElementById('password') as HTMLInputElement | null;

                    const togglePasswordConfirmationBtn = document.getElementById('togglePasswordConfirmation');
                    const passwordConfirmationInput = document.getElementById('password_confirmation') as HTMLInputElement | null;

                    if (togglePasswordBtn && passwordInput) {
                        togglePasswordBtn.addEventListener('click', () => {
                            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordInput.setAttribute('type', type);
                            // Cambia el icono
                            togglePasswordBtn.innerHTML = type === 'password' ? eyeIconSvg : eyeOffIconSvg;
                        });
                    }

                    if (togglePasswordConfirmationBtn && passwordConfirmationInput) {
                        togglePasswordConfirmationBtn.addEventListener('click', () => {
                            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordConfirmationInput.setAttribute('type', type);
                            // Cambia el icono
                            togglePasswordConfirmationBtn.innerHTML = type === 'password' ? eyeIconSvg : eyeOffIconSvg;
                        });
                    }
                },
                preConfirm: () => {
                    const password = (document.getElementById('password') as HTMLInputElement).value;
                    const password_confirmation = (document.getElementById('password_confirmation') as HTMLInputElement).value;

                    // Validación de frontend
                    if (!password || !password_confirmation) {
                        MySwal.showValidationMessage('Ambos campos son obligatorios.');
                        return false;
                    }
                    if (password !== password_confirmation) {
                        MySwal.showValidationMessage('Las contraseñas no coinciden.');
                        return false;
                    }

                    // --- LA NUEVA LÓGICA DE ENVÍO ---
                    return new Promise((resolve) => {
                        // Usamos router.put, que es más directo.
                        router.put(
                            '/password/force-update',
                            {
                                // Usamos .url, que es una propiedad del objeto devuelto
                                password,
                                password_confirmation,
                            },
                            {
                                preserveState: true,
                                preserveScroll: true,
                                onSuccess: () => resolve(true),
                                onError: (errors) => {
                                    MySwal.showValidationMessage(errors.password || 'Ha ocurrido un error.');
                                    resolve(false);
                                },
                            },
                        );
                    });
                },
            }).then((result: SweetAlertResult) => {
                if (result.isConfirmed) {
                    MySwal.fire({
                        icon: 'success',
                        title: '¡Contraseña Actualizada!',
                        text: 'Tu sesión continuará de forma segura.',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    // Ya no es necesario recargar, Inertia actualizará las props
                }
            });
        }
    }, [auth.user]); // Solo depende de auth.user

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        {/* <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" /> */}
                        <Switch />
                        <Label>Switch</Label>
                    </div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"></div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                    </div>
                </div>
                <div className="relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
            </div>
        </AppLayout>
    );
}
