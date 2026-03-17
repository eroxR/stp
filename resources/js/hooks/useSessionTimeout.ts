import { useEffect, useRef } from 'react';
import { usePage } from '@inertiajs/react';
import { MySwal } from '@/lib/swal'; // Usamos nuestra instancia themada
import type { SharedData } from '@/types';
import Swal from 'sweetalert2';

export function useSessionTimeout() {
    const { auth, session } = usePage<SharedData>().props;
    const warningTimer = useRef<NodeJS.Timeout | null>(null);
    const logoutTimer = useRef<NodeJS.Timeout | null>(null);

    // --- CONFIGURACIÓN ---
    // Duración de la sesión en segundos, viene del backend.
    const sessionLifetimeInSeconds = session.lifetime_in_seconds;
    // ¿Cuántos segundos ANTES de que expire la sesión quieres mostrar el aviso?
    const warningTimeInSeconds = 62; // 2 minutos

    // Función para cerrar sesión
    const logout = () => {
        // router.post('/logout');
        // window.location.href = '/logout';
        window.location.reload();
    };

    // Función para refrescar la sesión
    const refreshSession = async () => {
        try {
            // Hacemos una petición a nuestra ruta "ping"
            await fetch('/session/ping');
            // Si la petición es exitosa, reseteamos los timers
            resetTimers();
            MySwal.close();
        } catch (error) {
            console.error('Failed to refresh session:', error);
            // Si falla, probablemente la sesión ya expiró, así que cerramos.
            logout();
        }
    };

    // Función para mostrar el modal de advertencia
    const showWarningModal = () => {
        let timerInterval: NodeJS.Timeout;
        MySwal.fire({
            title: 'Tu sesión está a punto de expirar',
            html: `Serás desconectado en <b class="countdown-timer"></b> segundos.`,
            timer: warningTimeInSeconds * 1000,
            timerProgressBar: true,
            showDenyButton: true,
            confirmButtonText: 'Continuar sesión',
            denyButtonText: 'Cerrar sesión',
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                popup: 'swal-theme',
                confirmButton: 'swal-green', // Puedes usar clases específicas si quieres
                // denyButton: 'swal2-deny swal-red',
                denyButton: 'swal-red',
            },
            buttonsStyling: false,
            didOpen: () => {
                const b = Swal.getHtmlContainer()?.querySelector('.countdown-timer');
                if (b) {
                    const updateTimer = () => {
                        const timeLeft = Swal.getTimerLeft();
                        if (timeLeft !== undefined) {
                            b.textContent = Math.ceil(timeLeft / 1000).toString();
                        }
                    };
                    updateTimer(); // Llama una vez al inicio
                    timerInterval = setInterval(updateTimer, 100);
                }
            },
            willClose: () => {
                clearInterval(timerInterval);
            },
        }).then((result) => {
            if (result.isConfirmed) {
                // El usuario hizo clic en "Continuar sesión"
                refreshSession();
            } else if (result.isDenied) {
                // El usuario hizo clic en "Cerrar sesión"
                logout();
            }
            // Si el timer llega a cero, 'result.isDismissed' será true y
            // el logoutTimer principal se encargará de cerrar la sesión.
        });
    };

    // Función para resetear los temporizadores (se llama con la actividad del usuario)
    const resetTimers = () => {
        // Limpia cualquier timer que ya exista
        if (warningTimer.current) clearTimeout(warningTimer.current);
        if (logoutTimer.current) clearTimeout(logoutTimer.current);

        // Vuelve a configurar los timers
        warningTimer.current = setTimeout(showWarningModal, (sessionLifetimeInSeconds - warningTimeInSeconds) * 1000);
        logoutTimer.current = setTimeout(logout, sessionLifetimeInSeconds * 1000);
    };

    useEffect(() => {
        // No hacer nada si el usuario no está logueado
        if (!auth.user) {
            return;
        }

        const events = ['mousemove', 'mousedown', 'keypress', 'scroll', 'touchstart'];

        // Inicia los timers cuando el componente se monta
        resetTimers();

        // Añade los event listeners para resetear los timers con la actividad
        events.forEach((event) => {
            window.addEventListener(event, resetTimers);
        });

        // Función de limpieza: se ejecuta cuando el componente se desmonta
        return () => {
            if (warningTimer.current) clearTimeout(warningTimer.current);
            if (logoutTimer.current) clearTimeout(logoutTimer.current);
            events.forEach((event) => {
                window.removeEventListener(event, resetTimers);
            });
        };
    }, [auth.user]); // El efecto se reinicia si el usuario cambia (ej. al hacer logout)
}