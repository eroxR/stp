// import { DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
// import { Sheet, SheetContent, SheetDescription, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
// import { MySwal } from '@/lib/swal';
// import { cn } from '@/lib/utils';
// import {
//     archive as notificationsArchive,
//     destroy as notificationsDestroy,
//     read as notificationsRead,
//     unarchive as notificationsUnarchive,
// } from '@/routes/notifications';
// import { Alert, PageProps } from '@/types'; // Asegúrate de importar tus tipos
// import { router, usePage } from '@inertiajs/react';
// // import { Check } from 'lucide-react';
// import { Archive, ArchiveRestore, BadgeX, Bell, Calendar, Eye, EyeOff, FileText, MessageSquareWarning, Trash2, TriangleAlert } from 'lucide-react';
// import { ElementType, MouseEvent, useMemo } from 'react';
// import { renderToString } from 'react-dom/server';

// export function NotificationsMenuContent() {
//     // 1. Obtenemos los datos reales compartidos desde el Middleware de Laravel
//     const { auth } = usePage<PageProps>().props;
//     const { list: notifications, count } = auth.notifications;

//     // --- ACCIÓN PRINCIPAL CON SWEET ALERT 2 ---
//     const handleNotificationClick = (alert: Alert) => {
//         // 1. Marcar como leída en segundo plano si es nueva
//         const statusId = alert.status?.id || alert.alert_status?.id || 1;
//         if (statusId === 1) {
//             router.post(notificationsRead.url({ alert: alert.id }), {}, { preserveScroll: true, preserveState: true });
//         }

//         // 2. Preparar Iconos y Colores para el HTML del SweetAlert
//         const severity = alert.type?.severity_level || alert.alert_type?.severity_level || '1';
//         let colorClass = 'text-blue-600 dark:text-blue-500';
//         let MainIcon = MessageSquareWarning;
//         if (severity === '3') {
//             // Error
//             colorClass = 'text-red-600 dark:text-red-500';
//             MainIcon = BadgeX;
//         } else if (severity === '2') {
//             // Warning
//             colorClass = 'text-yellow-600 dark:text-yellow-500';
//             MainIcon = TriangleAlert;
//         }

//         // B. Determinar Icono y Texto de Estado (Para reemplazar el ID)
//         const rawIconKey = (alert.status?.icon_description || alert.alert_status?.icon_description || 'Eye').trim();
//         const statusName = alert.status?.name || alert.alert_status?.name || 'Notificación';

//         let StatusIcon = Eye;
//         if (rawIconKey === 'EyeOff') StatusIcon = EyeOff;
//         if (rawIconKey === 'Archive') StatusIcon = Archive;
//         if (rawIconKey === 'Trash2') StatusIcon = Trash2;
//         if (rawIconKey === 'ArchiveRestore') StatusIcon = ArchiveRestore;

//         // C. Renderizar Iconos a SVG Strings (Aplicando el color de severidad donde se pidió)
//         const mainIconSvg = renderToString(<MainIcon className={`h-7 w-7 ${colorClass}`} />);

//         // Iconos pequeños con el color de la severidad
//         const fileIconSvg = renderToString(<FileText className={`h-4 w-4 ${colorClass}`} />);
//         const calendarIconSvg = renderToString(<Calendar className={`h-3 w-3 ${colorClass}`} />);
//         const eyeIconSvg = renderToString(<Eye className={`h-3 w-3 ${colorClass}`} />);

//         // Icono de estado (Color neutro o específico de estado, no de severidad)
//         const statusIconSvg = renderToString(<StatusIcon className="h-5 w-5 text-muted-foreground" />);

//         // D. Preparar Datos de Texto
//         let description = alert.description_alert;
//         try {
//             if (description.trim().startsWith('{')) {
//                 const parsed = JSON.parse(description);
//                 description = parsed.message || parsed.error || description;
//             }
//         } catch {
//             // CORRECCIÓN AQUÍ: Agregamos un comentario para satisfacer la regla 'no-empty'
//             // Si falla el parseo, continuamos con el texto original
//         }

//         const dateCreated = new Date(alert.created_at).toLocaleString();
//         const dateAttended = alert.alert_attention_date ? new Date(alert.alert_attention_date).toLocaleString() : 'Pendiente';

//         // <p class="text-xs text-muted-foreground text-center mb-4">ID: #${alert.id}</p>
//         // 4. Disparar SweetAlert
//         MySwal.fire({
//             // Título con icono
//             title: `<div class="flex items-center gap-2 justify-center text-xl"> ${mainIconSvg} Detalles de la Alerta</div>`,
//             html: `
//                 <div class="text-left">

//                     <!-- REEMPLAZO DEL ID POR EL ESTADO -->
//                     <div class="flex items-center justify-center gap-2 mb-6 text-sm text-muted-foreground bg-gray-50 dark:bg-neutral-900/50 py-1.5 rounded-full w-fit mx-auto px-4 border">
//                         ${statusIconSvg}
//                         <span class="font-medium uppercase tracking-wide text-xs">${statusName}</span>
//                     </div>

//                     <!-- TÍTULO -->
//                     <div class="space-y-1 mb-5">
//                         <h4 class="text-sm font-bold ${colorClass}">Título</h4>
//                         <p class="text-base font-semibold text-foreground border-l-2 pl-3 ${colorClass.replace('text-', 'border-')} border-opacity-50">
//                             ${alert.title_alert}
//                         </p>
//                     </div>

//                     <!-- DESCRIPCIÓN -->
//                     <div class="space-y-1 rounded-md bg-gray-100 dark:bg-neutral-800 p-4 mb-5 border border-transparent focus-within:border-gray-200">
//                         <h4 class="flex items-center gap-2 text-sm font-bold ${colorClass}">
//                             ${fileIconSvg} Descripción
//                         </h4>
//                         <p class="text-sm mt-2 whitespace-pre-wrap text-foreground leading-relaxed break-words">${description}</p>
//                     </div>

//                     <!-- FECHAS (GRID) -->
//                     <div class="grid grid-cols-2 gap-6 pt-2 border-t dark:border-neutral-800">
//                         <div class="space-y-1">
//                             <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider ${colorClass}">
//                                 ${calendarIconSvg} Registrada
//                             </h4>
//                             <p class="text-sm text-foreground font-medium">${dateCreated}</p>
//                         </div>
//                         <div class="space-y-1">
//                             <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider ${colorClass}">
//                                 ${eyeIconSvg} Atendida
//                             </h4>
//                             <p class="text-sm text-foreground font-medium">${dateAttended}</p>
//                         </div>
//                     </div>
//                 </div>
//             `,
//             confirmButtonText: 'Cerrar',
//             customClass: {
//                 // Mantenemos la clase de tema general para el popup...
//                 popup: 'swal-theme',
//                 // ... ¡Y añadimos nuestra clase específica solo para el botón de confirmar!
//                 confirmButton: 'swal2-confirm swal-green',
//                 htmlContainer: '!text-left',
//             },
//             buttonsStyling: false,
//         });
//     };

//     // Nueva Acción: Archivar
//     const handleArchive = (e: MouseEvent<HTMLElement>, alert: Alert) => {
//         e.stopPropagation();

//         // 2. USAMOS TU OBJETO DE RUTAS IMPORTADO
//         router.put(notificationsArchive.url({ alert: alert.id }), {}, { preserveScroll: true });
//     };

//     // 3. NUEVA Acción: Desarchivar (Restaurar)
//     const handleUnarchive = (e: MouseEvent<HTMLElement>, alert: Alert) => {
//         e.stopPropagation();
//         router.put(notificationsUnarchive.url({ alert: alert.id }), {}, { preserveScroll: true });
//     };

//     // Nueva Acción: Eliminar
//     const handleDelete = (e: MouseEvent<HTMLElement>, alert: Alert) => {
//         e.stopPropagation();

//         // 2. USAMOS TU OBJETO DE RUTAS IMPORTADO
//         router.delete(notificationsDestroy.url({ alert: alert.id }), { preserveScroll: true });
//     };

//     // 1. Lógica de Colores de Texto según Severidad (AlertType)
//     const getSeverityBarColor = (level?: string) => {
//         // console.log('Severity Level:', level);
//         switch (level) {
//             case '3': // Danger
//                 return 'bg-red-600 dark:bg-red-500';
//             case '2': // Warning (Usamos Amber para que el dorado sea legible)
//                 return 'bg-yellow-600 dark:bg-yellow-500';
//             default: // Info (1)
//                 return 'bg-blue-600 dark:bg-blue-500';
//         }
//     };

//     // 2. NUEVO: Color del ICONO según el Estado (Lo que pediste ahora)
//     const getIconColor = (iconKey: string) => {
//         const key = iconKey.trim();
//         switch (key) {
//             case 'Eye':
//                 return 'text-blue-500 dark:text-blue-400'; // Azul para nuevas
//             case 'EyeOff':
//                 return 'text-red-500 dark:text-red-400'; // Rojo para leídas/bloqueadas
//             case 'Archive':
//                 return 'text-orange-500 dark:text-orange-400'; // Naranja para archivadas
//             case 'Trash2':
//                 return 'text-red-500 dark:text-red-400'; // Rojo para leídas/bloqueadas
//             case 'ArchiveRestore':
//                 return 'text-green-500 dark:text-green-400'; // Verde para restauradas
//             default:
//                 return 'text-muted-foreground'; // Gris por defecto
//         }
//     };

//     // 3. Lógica del TIEMPO (Relativo vs Absoluto)
//     const formatTimeDisplay = (notification: Alert, statusId: number) => {
//         // Asumiendo ID 1 = Nueva. Ajusta si tu ID es diferente.
//         const isNew = statusId === 1;

//         if (isNew) {
//             // Calcular tiempo relativo ("Hace X minutos")
//             const created = new Date(notification.created_at);
//             const now = new Date();
//             // Math.floor para evitar decimales
//             const diffInSeconds = Math.floor((now.getTime() - created.getTime()) / 1000);

//             if (diffInSeconds < 60) return 'Hace un momento';

//             const minutes = Math.floor(diffInSeconds / 60);
//             if (minutes < 60) return `Hace ${minutes} minuto${minutes !== 1 ? 's' : ''}`;

//             const hours = Math.floor(minutes / 60);
//             if (hours < 24) return `Hace ${hours} hora${hours !== 1 ? 's' : ''}`;

//             const days = Math.floor(hours / 24);
//             return `Hace ${days} día${days !== 1 ? 's' : ''}`;
//         } else {
//             // Mostrar fecha de gestión (attention_date) o actualización
//             // Validamos si existe alert_attention_date, si no, usamos updated_at
//             const dateString = notification.alert_attention_date || notification.updated_at;
//             const dateToUse = new Date(dateString);

//             return dateToUse.toLocaleString([], {
//                 day: '2-digit',
//                 month: '2-digit',
//                 year: 'numeric',
//                 hour: '2-digit',
//                 minute: '2-digit',
//             });
//         }
//     };

//     const iconMap: Record<string, ElementType> = {
//         Eye: Eye,
//         EyeOff: EyeOff,
//         Archive: Archive,
//         Trash2: Trash2,
//         // Agrega aquí los nombres exactos que guardaste en la columna 'icon_description'
//     };

//     // --- AGRUPAMIENTO PARA EL SHEET ---
//     // Agrupamos las notificaciones por estado para mostrarlas ordenadas en el panel lateral
//     const groupedNotifications = useMemo(() => {
//         const groups: Record<string, Alert[]> = {
//             Nuevas: [],
//             Leídas: [],
//             Archivadas: [],
//             Eliminadas: [],
//         };

//         notifications.forEach((n) => {
//             const statusId = n.status?.id || n.alert_status?.id || 1;
//             if (statusId === 1) groups['Nuevas'].push(n);
//             else if (statusId === 2) groups['Leídas'].push(n);
//             else if (statusId === 3) groups['Archivadas'].push(n);
//             else if (statusId === 4) groups['Eliminadas'].push(n);
//             else groups['Leídas'].push(n); // Fallback
//         });
//         return groups;
//     }, [notifications]);

//     // const iconMap: Record<string, ElementType> = { Eye, EyeOff, Archive, Trash2, ArchiveRestore, Bell };

//     // --- COMPONENTE INTERNO: TARJETA COMPLETA (Estilo SweetAlert) ---
//     const FullNotificationCard = ({ alert }: { alert: Alert }) => {
//         const type = alert.type || alert.alert_type;
//         const status = alert.status || alert.alert_status;
//         const severity = type?.severity_level || '1';
//         const statusId = status?.id || 1; // Obtenemos el ID del estado

//         let colorClass = 'text-blue-600 dark:text-blue-500';
//         let MainIcon = MessageSquareWarning;
//         if (severity === '3') {
//             colorClass = 'text-red-600 dark:text-red-500';
//             MainIcon = BadgeX;
//         } else if (severity === '2') {
//             colorClass = 'text-yellow-600 dark:text-yellow-500';
//             MainIcon = TriangleAlert;
//         }

//         const dateCreated = new Date(alert.created_at).toLocaleString();
//         const dateAttended = alert.alert_attention_date ? new Date(alert.alert_attention_date).toLocaleString() : 'Pendiente';

//         // Función para marcar como leída desde la tarjeta
//         const handleMarkAsRead = (e: MouseEvent<HTMLElement>, alert: Alert) => {
//             e.stopPropagation();
//             router.post(notificationsRead.url({ alert: alert.id }), {}, { preserveScroll: true, preserveState: true });
//         };

//         return (
//             <div className="relative mb-4 overflow-hidden rounded-lg border bg-card text-card-foreground shadow-sm">
//                 <div className={cn('absolute top-0 bottom-0 left-0 w-1.5', getSeverityBarColor(severity))} />

//                 <div className="p-4 pl-6">
//                     <div className="mb-3 flex items-center justify-between">
//                         <span className="rounded-md bg-muted px-2 py-0.5 text-[10px] text-muted-foreground">#{alert.id}</span>

//                         <div className="flex items-center gap-2">
//                             {/* --- NUEVO BOTÓN: SOLO SI ES NUEVA (ID 1) --- */}
//                             {statusId === 1 && (
//                                 <button
//                                     onClick={(e) => handleMarkAsRead(e, alert)}
//                                     className="mr-2 flex items-center gap-1 rounded bg-blue-50 px-2 py-1 text-xs font-medium text-blue-600 transition-colors hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-900/20 dark:hover:bg-blue-900/40"
//                                     title="Marcar como leída"
//                                 >
//                                     <Eye className="h-3 w-3" />
//                                     Marcar leída
//                                 </button>
//                             )}

//                             {/* Botones existentes */}
//                             {statusId !== 3 ? (
//                                 <button
//                                     onClick={(e) => handleArchive(e, alert)}
//                                     className="text-muted-foreground transition-colors hover:text-orange-500"
//                                     title="Archivar"
//                                 >
//                                     <Archive className="h-4 w-4" />
//                                 </button>
//                             ) : (
//                                 <button
//                                     onClick={(e) => handleUnarchive(e, alert)}
//                                     className="text-muted-foreground transition-colors hover:text-blue-500"
//                                     title="Desarchivar"
//                                 >
//                                     <ArchiveRestore className="h-4 w-4" />
//                                 </button>
//                             )}
//                             <button
//                                 onClick={(e) => handleDelete(e, alert)}
//                                 className="text-muted-foreground transition-colors hover:text-red-500"
//                                 title="Eliminar"
//                             >
//                                 <Trash2 className="h-4 w-4" />
//                             </button>
//                         </div>
//                     </div>

//                     <div className="mb-3 flex items-start gap-3">
//                         <MainIcon className={cn('mt-1 h-6 w-6 shrink-0', colorClass)} />
//                         <div>
//                             <h4 className="text-sm leading-tight font-bold">{alert.title_alert}</h4>
//                         </div>
//                     </div>

//                     <div className="mb-3 rounded-md border border-border/50 bg-muted/50 p-3 text-sm text-muted-foreground">
//                         <div className="mb-1 flex items-center gap-2 text-xs font-semibold opacity-70">
//                             <FileText className="h-3 w-3" /> Descripción
//                         </div>
//                         <p className="break-words whitespace-pre-wrap">{alert.description_alert}</p>
//                     </div>

//                     <div className="grid grid-cols-2 gap-2 border-t pt-3 text-xs text-muted-foreground">
//                         <div className="flex flex-col gap-1">
//                             <span className="flex items-center gap-1 font-semibold">
//                                 <Calendar className="h-3 w-3" /> Registrada
//                             </span>
//                             <span>{dateCreated}</span>
//                         </div>
//                         <div className="flex flex-col gap-1">
//                             <span className="flex items-center gap-1 font-semibold">
//                                 <Eye className="h-3 w-3" /> Atendida
//                             </span>
//                             <span>{dateAttended}</span>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         );
//     };

//     return (
//         <>
//             <DropdownMenuLabel className="flex items-center justify-between px-4 py-2">
//                 <span>Notificaciones</span>
//                 {count > 0 && <span className="rounded-full bg-primary/10 px-2 py-0.5 text-[10px] text-primary">{count} nuevas</span>}
//             </DropdownMenuLabel>
//             <DropdownMenuSeparator />

//             <div className="flex max-h-[300px] flex-col overflow-y-auto">
//                 {notifications.length > 0 ? (
//                     notifications.map((notification) => {
//                         const type = notification.type || notification.alert_type;
//                         const status = notification.status || notification.alert_status;

//                         const severityLevel = type?.severity_level || '1';
//                         const rawIconKey = status?.icon_description || 'Eye';
//                         const iconKey = rawIconKey.trim();
//                         const IconComponent = iconMap[iconKey] || Eye;

//                         // ID del estado para la lógica de tiempo
//                         const statusId = status?.id || 1;
//                         const isNew = statusId === 1;
//                         // 4. Identificar si está archivada (Asumiendo ID 3 = Archivado)
//                         const isArchived = statusId === 3;

//                         return (
//                             <DropdownMenuItem
//                                 key={notification.id}
//                                 className="group flex cursor-pointer items-center justify-between gap-3 p-3 focus:bg-accent"
//                                 // onClick={() => handleNotificationClick(notification)}
//                                 onSelect={() => {
//                                     // e.preventDefault();
//                                     handleNotificationClick(notification);
//                                 }}
//                             >
//                                 {/* CONTENEDOR IZQUIERDO */}
//                                 <div className="flex flex-1 items-start gap-3 overflow-hidden">
//                                     <div className={cn('mt-1 shrink-0', getIconColor(iconKey))}>
//                                         <IconComponent className={cn('h-5 w-5', getIconColor(iconKey))} />
//                                     </div>
//                                     <div className="flex flex-1 flex-col gap-1">
//                                         <div className="flex items-start gap-2">
//                                             {' '}
//                                             {/* items-start para alinear con multilinea */}
//                                             <div className={cn('mt-1.5 h-1 w-3 shrink-0 rounded-full', getSeverityBarColor(severityLevel))} />
//                                             {/* 5. TITULO COMPLETO: Quité 'truncate', agregué 'break-words' y 'whitespace-normal' */}
//                                             <p
//                                                 className={cn(
//                                                     'flex-1 text-left text-sm leading-5 break-words whitespace-normal transition-colors',
//                                                     isNew ? 'font-bold text-foreground' : 'font-normal text-muted-foreground',
//                                                 )}
//                                             >
//                                                 {notification.title_alert}
//                                             </p>
//                                             {/* <div className={cn('mt-1 h-3 w-1 shrink-0 rounded-full', getSeverityBarColor(severityLevel))} /> */}
//                                         </div>
//                                         <span className="pl-3 text-[11px] text-muted-foreground">{formatTimeDisplay(notification, statusId)}</span>
//                                     </div>
//                                 </div>

//                                 {/* CONTENEDOR DERECHO (Acciones) */}
//                                 <div className="flex flex-col items-center gap-2 pl-2 sm:flex-row">
//                                     {/* 6. LOGICA DE BOTONES: Si está archivado, muestra Desarchivar. Si no, Archivar */}
//                                     {isArchived ? (
//                                         <div
//                                             role="button"
//                                             onClick={(e) => handleUnarchive(e, notification)}
//                                             className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-blue-100 hover:text-blue-600 dark:hover:bg-blue-900/30"
//                                             title="Desarchivar"
//                                         >
//                                             <ArchiveRestore className={cn('h-5 w-5', getIconColor('ArchiveRestore'))} />
//                                         </div>
//                                     ) : (
//                                         <div
//                                             role="button"
//                                             onClick={(e) => handleArchive(e, notification)}
//                                             className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-orange-100 hover:text-orange-600 dark:hover:bg-orange-900/30"
//                                             title="Archivar"
//                                         >
//                                             <Archive className={cn('h-5 w-5', getIconColor('Archive'))} />
//                                         </div>
//                                     )}

//                                     <div
//                                         role="button"
//                                         onClick={(e) => handleDelete(e, notification)}
//                                         className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-red-100 hover:text-red-600 dark:hover:bg-red-900/30"
//                                         title="Eliminar"
//                                     >
//                                         <Trash2 className={cn('h-5 w-5', getIconColor('Trash2'))} />
//                                     </div>
//                                 </div>
//                             </DropdownMenuItem>
//                         );
//                     })
//                 ) : (
//                     <p className="p-4 text-center text-sm text-muted-foreground">No tienes notificaciones nuevas.</p>
//                 )}
//             </div>

//             <DropdownMenuSeparator />
//             {/* <DropdownMenuItem asChild> */}
//             {/* Puedes apuntar esto a una página dedicada de notificaciones */}
//             {/* <Link href={route('notifications.index')} className="flex cursor-pointer items-center justify-center p-2 font-medium"> */}
//             {/* <Link href="#" className="flex cursor-pointer items-center justify-center p-2 font-medium">
//                     Ver todas las notificaciones
//                 </Link>
//             </DropdownMenuItem> */}

//             {/* --- SHEET (PANEL LATERAL) PARA "VER TODAS" --- */}
//             <Sheet>
//                 <SheetTrigger asChild>
//                     <DropdownMenuItem
//                         className="flex cursor-pointer items-center justify-center p-2 font-medium text-primary hover:text-primary/80"
//                         // onSelect={(e) => e.preventDefault()}
//                     >
//                         Ver todas las notificaciones
//                     </DropdownMenuItem>
//                 </SheetTrigger>

//                 {/*
//                     CAMBIOS CSS AQUÍ:
//                     1. h-full: Ocupa toda la altura.
//                     2. flex flex-col: Organiza hijos en columna.
//                     3. p-0: Quitamos padding general para manejarlo por secciones.
//                 */}
//                 <SheetContent className="flex h-full w-full flex-col gap-0 p-0 sm:max-w-md" side="right">
//                     {/* CABECERA FIJA */}
//                     <div className="z-10 shrink-0 border-b bg-background p-6">
//                         <SheetHeader>
//                             <SheetTitle>Centro de Notificaciones</SheetTitle>
//                             <SheetDescription>Historial completo de alertas agrupadas por estado.</SheetDescription>
//                         </SheetHeader>
//                     </div>

//                     {/* ÁREA DE SCROLL (CONTENIDO) */}
//                     <div className="flex-1 overflow-y-auto p-6">
//                         <div className="space-y-8 pb-10">
//                             {groupedNotifications['Nuevas'].length > 0 && (
//                                 <div>
//                                     <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-blue-500">
//                                         <Eye className="h-4 w-4" /> Nuevas ({groupedNotifications['Nuevas'].length})
//                                     </h3>
//                                     {groupedNotifications['Nuevas'].map((alert) => (
//                                         <FullNotificationCard key={alert.id} alert={alert} />
//                                     ))}
//                                 </div>
//                             )}

//                             {groupedNotifications['Leídas'].length > 0 && (
//                                 <div>
//                                     <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-foreground">
//                                         <EyeOff className="h-4 w-4" /> Leídas / Resueltas ({groupedNotifications['Leídas'].length})
//                                     </h3>
//                                     {groupedNotifications['Leídas'].map((alert) => (
//                                         <FullNotificationCard key={alert.id} alert={alert} />
//                                     ))}
//                                 </div>
//                             )}

//                             {groupedNotifications['Archivadas'].length > 0 && (
//                                 <div>
//                                     <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-orange-500">
//                                         <Archive className="h-4 w-4" /> Archivadas ({groupedNotifications['Archivadas'].length})
//                                     </h3>
//                                     {groupedNotifications['Archivadas'].map((alert) => (
//                                         <FullNotificationCard key={alert.id} alert={alert} />
//                                     ))}
//                                 </div>
//                             )}

//                             {/* AHORA SÍ APARECERÁN PORQUE EL BACKEND YA LAS ENVÍA */}
//                             {groupedNotifications['Eliminadas'].length > 0 && (
//                                 <div>
//                                     <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-red-500">
//                                         <Trash2 className="h-4 w-4" /> Papelera ({groupedNotifications['Eliminadas'].length})
//                                     </h3>
//                                     {groupedNotifications['Eliminadas'].map((alert) => (
//                                         <FullNotificationCard key={alert.id} alert={alert} />
//                                     ))}
//                                 </div>
//                             )}

//                             {Object.values(groupedNotifications).every((arr) => arr.length === 0) && (
//                                 <div className="flex h-full flex-col items-center justify-center pt-20 text-sm text-muted-foreground">
//                                     <Bell className="mb-3 h-10 w-10 opacity-20" />
//                                     No hay notificaciones para mostrar.
//                                 </div>
//                             )}
//                         </div>
//                     </div>
//                 </SheetContent>
//             </Sheet>
//         </>
//     );
// }

import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Sheet, SheetContent, SheetHeader, SheetTitle } from '@/components/ui/sheet';
import { MySwal } from '@/lib/swal';
import { cn } from '@/lib/utils';
import {
    archive as notificationsArchive,
    destroy as notificationsDestroy,
    read as notificationsRead,
    unarchive as notificationsUnarchive,
} from '@/routes/notifications';
import { Alert, PageProps } from '@/types';
import { router, usePage } from '@inertiajs/react';
import axios from 'axios';
import {
    Archive,
    ArchiveRestore,
    BadgeX,
    Bell,
    Calendar,
    Eye,
    EyeOff,
    FileText,
    // Info,
    Loader2,
    MessageSquareWarning,
    Trash2,
    TriangleAlert,
} from 'lucide-react';
import { ElementType, MouseEvent, useEffect, useMemo, useState } from 'react';
import { renderToString } from 'react-dom/server';

export function NotificationsMenu() {
    const { auth } = usePage<PageProps>().props;
    const { list: initialNotifications, count } = auth.notifications;
    const unreadCount = auth.notifications.count;

    // --- ESTADOS CONTROLADOS ---
    const [isDropdownOpen, setIsDropdownOpen] = useState(false);
    const [isSheetOpen, setIsSheetOpen] = useState(false);

    // Estado para el historial completo del Sheet
    const [fullHistory, setFullHistory] = useState<Alert[]>([]);
    const [isLoadingHistory, setIsLoadingHistory] = useState(false);

    // --- FUNCIÓN CLAVE: RECARGAR HISTORIAL ---
    // Esta función se llamará cada vez que una acción se complete con éxito
    const refreshHistory = () => {
        // No activamos isLoadingHistory para evitar parpadeos molestos,
        // solo actualizamos los datos silenciosamente.
        axios
            .get('/notifications/history')
            .then((response) => setFullHistory(response.data))
            .catch((err) => console.error(err));
    };

    // --- ABRIR SHEET Y CARGAR HISTORIAL ---
    const openSheet = () => {
        setIsDropdownOpen(false);
        setTimeout(() => setIsSheetOpen(true), 150);

        // Solo cargamos si no tenemos datos aún
        if (fullHistory.length === 0) {
            setIsLoadingHistory(true);
            axios
                .get('/notifications/history')
                .then((response) => {
                    setFullHistory(response.data);
                })
                .catch((error) => {
                    console.error('Error cargando notificaciones:', error);
                })
                .finally(() => {
                    setIsLoadingHistory(false);
                });
        } else {
            // Si ya está abierto, refrescamos por si acaso hubo cambios recientes
            refreshHistory();
        }
    };

    // Actualizar fullHistory si initialNotifications cambia (ej: al leer una alerta)
    // Esto mantiene sincronizado lo básico mientras se carga o si ya se cargó
    useEffect(() => {
        if (fullHistory.length > 0) {
            refreshHistory();
        }
    }, [count]); // Dependencia: count (cambia cuando lees algo)

    // --- ACCIÓN PRINCIPAL ---
    const handleNotificationClick = (alert: Alert) => {
        const statusId = alert.status?.id || alert.alert_status?.id || 1;
        if (statusId === 1) {
            router.post(
                notificationsRead.url({ alert: alert.id }),
                {},
                { preserveScroll: true, preserveState: true, onSuccess: () => refreshHistory() },
            );
        }
        // ... (Tu lógica de SweetAlert se mantiene igual)
        showDetailAlert(alert);
    };

    // Extraje la lógica del SweetAlert para no repetir código
    const showDetailAlert = (alert: Alert) => {
        // 2. Preparar Iconos y Colores para el HTML del SweetAlert
        const severity = alert.type?.severity_level || alert.alert_type?.severity_level || '1';
        let colorClass = 'text-blue-600 dark:text-blue-500';
        let MainIcon = MessageSquareWarning;
        if (severity === '3') {
            // Error
            colorClass = 'text-red-600 dark:text-red-500';
            MainIcon = BadgeX;
        } else if (severity === '2') {
            // Warning
            colorClass = 'text-yellow-600 dark:text-yellow-500';
            MainIcon = TriangleAlert;
        }

        // B. Determinar Icono y Texto de Estado (Para reemplazar el ID)
        const rawIconKey = (alert.status?.icon_description || alert.alert_status?.icon_description || 'Eye').trim();
        const statusName = alert.status?.name || alert.alert_status?.name || 'Notificación';

        let StatusIcon = Eye;
        if (rawIconKey === 'EyeOff') StatusIcon = EyeOff;
        if (rawIconKey === 'Archive') StatusIcon = Archive;
        if (rawIconKey === 'Trash2') StatusIcon = Trash2;
        if (rawIconKey === 'ArchiveRestore') StatusIcon = ArchiveRestore;

        // C. Renderizar Iconos a SVG Strings (Aplicando el color de severidad donde se pidió)
        const mainIconSvg = renderToString(<MainIcon className={`h-7 w-7 ${colorClass}`} />);

        // Iconos pequeños con el color de la severidad
        const fileIconSvg = renderToString(<FileText className={`h-4 w-4 ${colorClass}`} />);
        const calendarIconSvg = renderToString(<Calendar className={`h-3 w-3 ${colorClass}`} />);
        const eyeIconSvg = renderToString(<Eye className={`h-3 w-3 ${colorClass}`} />);

        // Icono de estado (Color neutro o específico de estado, no de severidad)
        const statusIconSvg = renderToString(<StatusIcon className="h-5 w-5 text-muted-foreground" />);

        // D. Preparar Datos de Texto
        let description = alert.description_alert;
        try {
            if (description.trim().startsWith('{')) {
                const parsed = JSON.parse(description);
                description = parsed.message || parsed.error || description;
            }
        } catch {
            // CORRECCIÓN AQUÍ: Agregamos un comentario para satisfacer la regla 'no-empty'
            // Si falla el parseo, continuamos con el texto original
        }

        const dateCreated = new Date(alert.created_at).toLocaleString();
        const dateAttended = alert.alert_attention_date ? new Date(alert.alert_attention_date).toLocaleString() : 'Pendiente';

        // <p class="text-xs text-muted-foreground text-center mb-4">ID: #${alert.id}</p>
        // 4. Disparar SweetAlert
        MySwal.fire({
            // Título con icono
            title: `<div class="flex items-center gap-2 justify-center text-xl"> ${mainIconSvg} Detalles de la Alerta</div>`,
            html: `
                <div class="text-left">

                    <!-- REEMPLAZO DEL ID POR EL ESTADO -->
                    <div class="flex items-center justify-center gap-2 mb-6 text-sm text-muted-foreground bg-gray-50 dark:bg-neutral-900/50 py-1.5 rounded-full w-fit mx-auto px-4 border">
                        ${statusIconSvg}
                        <span class="font-medium uppercase tracking-wide text-xs">${statusName}</span>
                    </div>

                    <!-- TÍTULO -->
                    <div class="space-y-1 mb-5">
                        <h4 class="text-sm font-bold ${colorClass}">Título</h4>
                        <p class="text-base font-semibold text-foreground border-l-2 pl-3 ${colorClass.replace('text-', 'border-')} border-opacity-50">
                            ${alert.title_alert}
                        </p>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="space-y-1 rounded-md bg-gray-100 dark:bg-neutral-800 p-4 mb-5 border border-transparent focus-within:border-gray-200">
                        <h4 class="flex items-center gap-2 text-sm font-bold ${colorClass}">
                            ${fileIconSvg} Descripción
                        </h4>
                        <p class="text-sm mt-2 whitespace-pre-wrap text-foreground leading-relaxed break-words">${description}</p>
                    </div>

                    <!-- FECHAS (GRID) -->
                    <div class="grid grid-cols-2 gap-6 pt-2 border-t dark:border-neutral-800">
                        <div class="space-y-1">
                            <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider ${colorClass}">
                                ${calendarIconSvg} Registrada
                            </h4>
                            <p class="text-sm text-foreground font-medium">${dateCreated}</p>
                        </div>
                        <div class="space-y-1">
                            <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider ${colorClass}">
                                ${eyeIconSvg} Atendida
                            </h4>
                            <p class="text-sm text-foreground font-medium">${dateAttended}</p>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonText: 'Cerrar',
            customClass: {
                // Mantenemos la clase de tema general para el popup...
                popup: 'swal-theme',
                // ... ¡Y añadimos nuestra clase específica solo para el botón de confirmar!
                confirmButton: 'swal2-confirm swal-green',
                htmlContainer: '!text-left',
            },
            buttonsStyling: false,
        });
    };

    // --- ACCIONES DE BOTONES ---
    const handleArchive = (e: MouseEvent<HTMLElement>, alert: Alert) => {
        e.stopPropagation();
        router.put(notificationsArchive.url({ alert: alert.id }), {}, { preserveScroll: true, onSuccess: () => refreshHistory() });
    };
    const handleUnarchive = (e: MouseEvent<HTMLElement>, alert: Alert) => {
        e.stopPropagation();
        router.put(notificationsUnarchive.url({ alert: alert.id }), {}, { preserveScroll: true, onSuccess: () => refreshHistory() });
    };
    const handleDelete = (e: MouseEvent<HTMLElement>, alert: Alert) => {
        e.stopPropagation();
        router.delete(notificationsDestroy.url({ alert: alert.id }), { preserveScroll: true, onSuccess: () => refreshHistory() });
    };
    const handleMarkAsRead = (e: MouseEvent<HTMLElement>, alert: Alert) => {
        e.stopPropagation();
        router.post(notificationsRead.url({ alert: alert.id }), {}, { preserveScroll: true, preserveState: true, onSuccess: () => refreshHistory() });
    };

    // --- HELPERS VISUALES ---
    const getSeverityBarColor = (level?: string) => {
        switch (level) {
            case '3':
                return 'bg-red-600 dark:bg-red-500';
            case '2':
                return 'bg-yellow-600 dark:bg-yellow-500';
            default:
                return 'bg-blue-600 dark:bg-blue-500';
        }
    };
    const getIconColor = (iconKey: string) => {
        const key = iconKey.trim();
        switch (key) {
            case 'Eye':
                return 'text-blue-500 dark:text-blue-400';
            case 'EyeOff':
                return 'text-red-500 dark:text-red-400';
            case 'Archive':
                return 'text-orange-500 dark:text-orange-400';
            case 'Trash2':
                return 'text-red-500 dark:text-red-400';
            case 'ArchiveRestore':
                return 'text-green-500 dark:text-green-400';
            default:
                return 'text-muted-foreground';
        }
    };
    const formatTimeDisplay = (notification: Alert, statusId: number) => {
        const isNew = statusId === 1;
        if (isNew) {
            const created = new Date(notification.created_at);
            const now = new Date();
            const diffInSeconds = Math.floor((now.getTime() - created.getTime()) / 1000);
            if (diffInSeconds < 60) return 'Hace un momento';
            const minutes = Math.floor(diffInSeconds / 60);
            if (minutes < 60) return `Hace ${minutes} min`;
            const hours = Math.floor(minutes / 60);
            if (hours < 24) return `Hace ${hours} h`;
            return `Hace ${Math.floor(hours / 24)} d`;
        } else {
            const dateToUse = new Date(notification.alert_attention_date || notification.updated_at);
            return dateToUse.toLocaleString([], { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        }
    };

    // --- AGRUPAMIENTO PARA EL SHEET ---
    const groupedNotifications = useMemo(() => {
        const groups: Record<string, Alert[]> = {
            Nuevas: [],
            Leídas: [],
            Archivadas: [],
            Eliminadas: [],
        };

        // Usamos fullHistory si tiene datos, si no (mientras carga la primera vez), usamos la lista inicial
        // para que no se vea vacío instantáneamente
        // const sourceList = fullHistory.length > 0 ? fullHistory : [];
        const sourceList = fullHistory;

        sourceList.forEach((n) => {
            const statusId = n.status?.id || n.alert_status?.id || 1;
            if (statusId === 1) groups['Nuevas'].push(n);
            else if (statusId === 2) groups['Leídas'].push(n);
            else if (statusId === 3) groups['Archivadas'].push(n);
            else if (statusId === 4) groups['Eliminadas'].push(n);
            else groups['Leídas'].push(n);
        });
        return groups;
    }, [fullHistory]); // Depende de fullHistory

    const iconMap: Record<string, ElementType> = { Eye, EyeOff, Archive, Trash2, ArchiveRestore, Bell };

    // --- COMPONENTE INTERNO: TARJETA COMPLETA ---
    const FullNotificationCard = ({ alert }: { alert: Alert }) => {
        const type = alert.type || alert.alert_type;
        const status = alert.status || alert.alert_status;
        const severity = type?.severity_level || '1';
        const statusId = status?.id || 1;

        let colorClass = 'text-blue-600 dark:text-blue-500';
        let MainIcon = MessageSquareWarning;
        if (severity === '3') {
            colorClass = 'text-red-600 dark:text-red-500';
            MainIcon = BadgeX;
        } else if (severity === '2') {
            colorClass = 'text-yellow-600 dark:text-yellow-500';
            MainIcon = TriangleAlert;
        }

        const dateCreated = new Date(alert.created_at).toLocaleString();
        const dateAttended = alert.alert_attention_date ? new Date(alert.alert_attention_date).toLocaleString() : 'Pendiente';

        return (
            <div
                className="relative mb-4 cursor-pointer overflow-hidden rounded-lg border bg-card text-card-foreground shadow-sm transition-colors hover:bg-accent/50"
                onClick={() => showDetailAlert(alert)} // Al hacer clic en la tarjeta, abre el detalle
            >
                <div className={cn('absolute top-0 bottom-0 left-0 w-1.5', getSeverityBarColor(severity))} />

                <div className="p-4 pl-6">
                    <div className="mb-3 flex items-center justify-between">
                        <span className="rounded-md bg-muted px-2 py-0.5 text-[10px] text-muted-foreground">#{alert.id}</span>

                        <div className="flex items-center gap-2">
                            {statusId === 1 && (
                                <button
                                    onClick={(e) => handleMarkAsRead(e, alert)}
                                    className="mr-2 flex items-center gap-1 rounded bg-blue-50 px-2 py-1 text-xs font-medium text-blue-600 transition-colors hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-900/20 dark:hover:bg-blue-900/40"
                                    title="Marcar como leída"
                                >
                                    <Eye className="h-3 w-3" />
                                    Marcar leída
                                </button>
                            )}

                            {/* CONDICIONAL: SI ESTÁ ELIMINADA (ID 4), NO MOSTRAR BOTONES */}
                            {statusId !== 4 && (
                                <>
                                    {statusId !== 3 ? (
                                        <button
                                            onClick={(e) => handleArchive(e, alert)}
                                            className="text-muted-foreground transition-colors hover:text-orange-500"
                                            title="Archivar"
                                        >
                                            <Archive className="h-4 w-4" />
                                        </button>
                                    ) : (
                                        <button
                                            onClick={(e) => handleUnarchive(e, alert)}
                                            className="text-muted-foreground transition-colors hover:text-green-500"
                                            title="Desarchivar"
                                        >
                                            <ArchiveRestore className="h-4 w-4" />
                                        </button>
                                    )}
                                    <button
                                        onClick={(e) => handleDelete(e, alert)}
                                        className="text-muted-foreground transition-colors hover:text-red-500"
                                        title="Eliminar"
                                    >
                                        <Trash2 className="h-4 w-4" />
                                    </button>
                                </>
                            )}
                        </div>
                    </div>

                    <div className="mb-3 flex items-start gap-3">
                        <MainIcon className={cn('mt-1 h-6 w-6 shrink-0', colorClass)} />
                        <div>
                            <h4 className="text-sm leading-tight font-bold">{alert.title_alert}</h4>
                        </div>
                    </div>

                    <div className="mb-3 rounded-md border border-border/50 bg-muted/50 p-3 text-sm text-muted-foreground">
                        <div className="mb-1 flex items-center gap-2 text-xs font-semibold opacity-70">
                            <FileText className="h-3 w-3" /> Descripción
                        </div>
                        <p className="break-words whitespace-pre-wrap">{alert.description_alert}</p>
                    </div>

                    <div className="grid grid-cols-2 gap-2 border-t pt-3 text-xs text-muted-foreground">
                        <div className="flex flex-col gap-1">
                            <span className="flex items-center gap-1 font-semibold">
                                <Calendar className="h-3 w-3" /> Registrada
                            </span>
                            <span>{dateCreated}</span>
                        </div>
                        <div className="flex flex-col gap-1">
                            <span className="flex items-center gap-1 font-semibold">
                                <Eye className="h-3 w-3" /> Atendida
                            </span>
                            <span>{dateAttended}</span>
                        </div>
                    </div>
                </div>
            </div>
        );
    };

    return (
        <>
            {/* SHEET (PANEL LATERAL) - AHORA COMO HERMANO DEL DROPDOWN */}
            <Sheet open={isSheetOpen} onOpenChange={setIsSheetOpen}>
                <SheetContent className="flex h-full w-full flex-col gap-0 p-0 sm:max-w-md" side="right">
                    <div className="z-10 shrink-0 border-b bg-background p-2">
                        <SheetHeader>
                            <div className="flex items-center justify-between gap-2">
                                <SheetTitle>Centro de Notificaciones</SheetTitle>
                                <div className="flex gap-1.5">
                                    {groupedNotifications['Nuevas'].length > 0 && (
                                        <div className="flex items-center gap-1 rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                            <Eye className="h-3 w-3" />
                                            {groupedNotifications['Nuevas'].length}
                                        </div>
                                    )}
                                    {groupedNotifications['Leídas'].length > 0 && (
                                        <div className="flex items-center gap-1 rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                            <EyeOff className="h-3 w-3" />
                                            {groupedNotifications['Leídas'].length}
                                        </div>
                                    )}
                                    {groupedNotifications['Archivadas'].length > 0 && (
                                        <div className="flex items-center gap-1 rounded-full bg-orange-100 px-2 py-0.5 text-[10px] font-bold text-orange-700 dark:bg-orange-900/30 dark:text-orange-400">
                                            <Archive className="h-3 w-3" />
                                            {groupedNotifications['Archivadas'].length}
                                        </div>
                                    )}
                                    {groupedNotifications['Eliminadas'].length > 0 && (
                                        <div className="flex items-center gap-1 rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-bold text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                            <Trash2 className="h-3 w-3" />
                                            {groupedNotifications['Eliminadas'].length}
                                        </div>
                                    )}
                                </div>
                            </div>
                            {/* <SheetDescription>Historial completo de alertas agrupadas por estado.</SheetDescription> */}
                        </SheetHeader>
                    </div>

                    <div className="flex-1 overflow-y-auto p-6">
                        {/* --- ESTADO DE CARGA --- */}
                        {isLoadingHistory && fullHistory.length === 0 ? (
                            <div className="flex h-full flex-col items-center justify-center text-muted-foreground">
                                <Loader2 className="mb-2 h-8 w-8 animate-spin" />
                                <p className="text-sm">Cargando historial...</p>
                            </div>
                        ) : (
                            /* --- CONTENIDO CARGADO --- */
                            <div className="space-y-8 pb-10">
                                {groupedNotifications['Nuevas'].length > 0 && (
                                    <div>
                                        <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-blue-500">
                                            <Eye className="h-4 w-4" /> Nuevas ({groupedNotifications['Nuevas'].length})
                                        </h3>
                                        {groupedNotifications['Nuevas'].map((alert) => (
                                            <FullNotificationCard key={alert.id} alert={alert} />
                                        ))}
                                    </div>
                                )}
                                {groupedNotifications['Leídas'].length > 0 && (
                                    <div>
                                        <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-foreground">
                                            <EyeOff className="h-4 w-4" /> Leídas / Resueltas ({groupedNotifications['Leídas'].length})
                                        </h3>
                                        {groupedNotifications['Leídas'].map((alert) => (
                                            <FullNotificationCard key={alert.id} alert={alert} />
                                        ))}
                                    </div>
                                )}
                                {groupedNotifications['Archivadas'].length > 0 && (
                                    <div>
                                        <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-orange-500">
                                            <Archive className="h-4 w-4" /> Archivadas ({groupedNotifications['Archivadas'].length})
                                        </h3>
                                        {groupedNotifications['Archivadas'].map((alert) => (
                                            <FullNotificationCard key={alert.id} alert={alert} />
                                        ))}
                                    </div>
                                )}
                                {groupedNotifications['Eliminadas'].length > 0 && (
                                    <div>
                                        <h3 className="mb-3 flex items-center gap-2 text-sm font-semibold text-red-500">
                                            <Trash2 className="h-4 w-4" /> Papelera ({groupedNotifications['Eliminadas'].length})
                                        </h3>
                                        {groupedNotifications['Eliminadas'].map((alert) => (
                                            <FullNotificationCard key={alert.id} alert={alert} />
                                        ))}
                                    </div>
                                )}
                                {Object.values(groupedNotifications).every((arr) => arr.length === 0) && (
                                    <div className="flex h-full flex-col items-center justify-center pt-20 text-sm text-muted-foreground">
                                        <Bell className="mb-3 h-10 w-10 opacity-20" /> No hay notificaciones para mostrar.
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </SheetContent>
            </Sheet>

            {/* DROPDOWN MENU - AHORA CONTROLADO */}
            <DropdownMenu open={isDropdownOpen} onOpenChange={setIsDropdownOpen}>
                <DropdownMenuTrigger asChild>
                    <Button variant="ghost" size="icon" className="relative h-9 w-9">
                        {unreadCount > 0 && (
                            <div className="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center">
                                <span className="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75" />
                                <span className="relative inline-flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-[10px] font-bold text-white ring-2 ring-background">
                                    {unreadCount > 99 ? '99+' : unreadCount}
                                </span>
                            </div>
                        )}
                        <Bell className="h-5 w-5" />
                    </Button>
                </DropdownMenuTrigger>

                <DropdownMenuContent className="w-80" align="end">
                    <DropdownMenuLabel className="flex items-center justify-between px-4 py-2">
                        <span>Notificaciones</span>
                        {count > 0 && <span className="rounded-full bg-primary/10 px-2 py-0.5 text-[10px] text-primary">{count} nuevas</span>}
                    </DropdownMenuLabel>
                    <DropdownMenuSeparator />

                    <div className="flex max-h-[300px] flex-col overflow-y-auto">
                        {initialNotifications.length > 0 ? (
                            initialNotifications.map((notification) => {
                                const type = notification.type || notification.alert_type;
                                const status = notification.status || notification.alert_status;
                                const severityLevel = type?.severity_level || '1';
                                const rawIconKey = status?.icon_description || 'Eye';
                                const iconKey = rawIconKey.trim();
                                const IconComponent = iconMap[iconKey] || Eye;
                                const statusId = status?.id || 1;
                                const isNew = statusId === 1;
                                const isArchived = statusId === 3;

                                if (statusId === 4) return null;

                                return (
                                    <DropdownMenuItem
                                        key={notification.id}
                                        className="group flex cursor-pointer items-center justify-between gap-3 p-3 focus:bg-accent"
                                        // onClick={() => handleNotificationClick(notification)}
                                        onSelect={() => {
                                            // e.preventDefault();
                                            handleNotificationClick(notification);
                                        }}
                                    >
                                        {/* CONTENEDOR IZQUIERDO */}
                                        <div className="flex flex-1 items-start gap-3 overflow-hidden">
                                            <div className={cn('mt-1 shrink-0', getIconColor(iconKey))}>
                                                <IconComponent className={cn('h-5 w-5', getIconColor(iconKey))} />
                                            </div>
                                            <div className="flex flex-1 flex-col gap-1">
                                                <div className="flex items-start gap-2">
                                                    {' '}
                                                    {/* items-start para alinear con multilinea */}
                                                    <div className={cn('mt-1.5 h-1 w-3 shrink-0 rounded-full', getSeverityBarColor(severityLevel))} />
                                                    {/* 5. TITULO COMPLETO: Quité 'truncate', agregué 'break-words' y 'whitespace-normal' */}
                                                    <p
                                                        className={cn(
                                                            'flex-1 text-left text-sm leading-5 break-words whitespace-normal transition-colors',
                                                            isNew ? 'font-bold text-foreground' : 'font-normal text-muted-foreground',
                                                        )}
                                                    >
                                                        {notification.title_alert}
                                                    </p>
                                                    {/* <div className={cn('mt-1 h-3 w-1 shrink-0 rounded-full', getSeverityBarColor(severityLevel))} /> */}
                                                </div>
                                                <span className="pl-3 text-[11px] text-muted-foreground">
                                                    {formatTimeDisplay(notification, statusId)}
                                                </span>
                                            </div>
                                        </div>

                                        {/* CONTENEDOR DERECHO (Acciones) */}
                                        <div className="flex flex-col items-center gap-2 pl-2 sm:flex-row">
                                            {/* 6. LOGICA DE BOTONES: Si está archivado, muestra Desarchivar. Si no, Archivar */}
                                            {isArchived ? (
                                                <div
                                                    role="button"
                                                    onClick={(e) => handleUnarchive(e, notification)}
                                                    className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-blue-100 hover:text-blue-600 dark:hover:bg-blue-900/30"
                                                    title="Desarchivar"
                                                >
                                                    <ArchiveRestore className={cn('h-5 w-5', getIconColor('ArchiveRestore'))} />
                                                </div>
                                            ) : (
                                                <div
                                                    role="button"
                                                    onClick={(e) => handleArchive(e, notification)}
                                                    className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-orange-100 hover:text-orange-600 dark:hover:bg-orange-900/30"
                                                    title="Archivar"
                                                >
                                                    <Archive className={cn('h-5 w-5', getIconColor('Archive'))} />
                                                </div>
                                            )}

                                            <div
                                                role="button"
                                                onClick={(e) => handleDelete(e, notification)}
                                                className="rounded-md p-1.5 text-muted-foreground transition-colors hover:bg-red-100 hover:text-red-600 dark:hover:bg-red-900/30"
                                                title="Eliminar"
                                            >
                                                <Trash2 className={cn('h-5 w-5', getIconColor('Trash2'))} />
                                            </div>
                                        </div>
                                    </DropdownMenuItem>
                                );
                            })
                        ) : (
                            <p className="p-4 text-center text-sm text-muted-foreground">No tienes notificaciones nuevas.</p>
                        )}
                    </div>

                    <DropdownMenuSeparator />
                    <DropdownMenuItem
                        className="flex cursor-pointer items-center justify-center p-2 font-medium text-primary hover:text-primary/80"
                        onClick={openSheet} // Usamos nuestra función personalizada
                    >
                        Ver todas las notificaciones
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </>
    );
}
