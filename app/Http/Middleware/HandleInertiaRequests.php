<?php

namespace App\Http\Middleware;

use App\Models\alert;
use App\Models\AlertStatus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
                'notifications' => function () use ($request) {
                    if (!$request->user()) {
                        return null;
                    }

                    $companyId = $request->user()->company_id;

                    // Definimos las relaciones a cargar (usando los nombres de tu modelo)
                    // Si renombraste a 'type' y 'status', usa esos. Si no, usa 'alertType' y 'alertStatus'.
                    $relations = ['alertType', 'alertStatus'];

                    // 1. Obtener las últimas 6 NUEVAS (ID 1)
                    $newAlerts = alert::query()
                        ->with($relations)
                        ->where('company_id', $companyId)
                        ->where('alertstatus_id', AlertStatus::STATUS_NEW) // ID 1
                        ->orderByDesc('created_at')
                        ->limit(6)
                        ->get();

                    // 2. Obtener las últimas 3 RESUELTAS/LEÍDAS (ID 2)
                    $resolvedAlerts = alert::query()
                        ->with($relations)
                        ->where('company_id', $companyId)
                        ->where('alertstatus_id', AlertStatus::STATUS_RESOLVED) // ID 2
                        ->orderByDesc('alert_attention_date') // Ordenar por fecha de atención o created_at
                        ->limit(3)
                        ->get();

                    // 3. Obtener las últimas 6 ARCHIVADAS (ID 3)
                    $archivedAlerts = alert::query()
                        ->with($relations)
                        ->where('company_id', $companyId)
                        ->where('alertstatus_id', AlertStatus::STATUS_ARCHIVED) // ID 3
                        ->orderByDesc('created_at')
                        ->limit(6)
                        ->get();

                    $deletedAlerts = alert::query()
                        ->with($relations)
                        ->where('company_id', $companyId)
                        ->where('alertstatus_id', AlertStatus::STATUS_DELETED) // ID 4
                        ->orderByDesc('updated_at') // Ordenar por fecha de eliminación/actualización
                        ->limit(5) // Limitar para no sobrecargar
                        ->get();

                    // 4. Unir las colecciones en el orden específico
                    // El resultado será una lista ordenada: Primero Nuevas, luego Resueltas, luego Archivadas
                    $notificationsList = $newAlerts
                        ->concat($resolvedAlerts)
                        ->concat($archivedAlerts)
                        ->concat($deletedAlerts);;

                    // 5. Contar SOLO las nuevas para el círculo rojo de la campana
                    $countNew = alert::query()
                        ->where('company_id', $companyId)
                        ->where('alertstatus_id', AlertStatus::STATUS_NEW)
                        ->count();

                    return [
                        'list' => $notificationsList,
                        'count' => $countNew,
                    ];
                },
            ],
            'session' => [
                'lifetime_in_seconds' => config('session.lifetime') * 60,
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }
}
