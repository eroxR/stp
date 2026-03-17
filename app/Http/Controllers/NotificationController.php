<?php

namespace App\Http\Controllers;

use App\Models\alert;
use App\Models\AlertStatus;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Marcar una alerta específica como "Atendida/Leída" (ID 2)
    public function markAsRead(Request $request, alert $alert)
    {
        if ($alert->company_id !== $request->user()->company_id) {
            abort(403);
        }

        $alert->update([
            'alertstatus_id' => AlertStatus::STATUS_RESOLVED,
            'alert_attention_date' => now(),
        ]);

        return back();
    }

    // Marcar todas como leídas (Opcional)
    public function markAllAsRead(Request $request)
    {
        alert::where('company_id', $request->user()->company_id)
            ->where('alertstatus_id', AlertStatus::STATUS_NEW)
            ->update([
                'alertstatus_id' => AlertStatus::STATUS_RESOLVED,
                'alert_attention_date' => now(),
            ]);

        return back();
    }

    // --- NUEVO: Archivar la alerta (Estado 3) ---
    public function archive(Request $request, alert $alert)
    {
        if ($alert->company_id !== $request->user()->company_id) {
            abort(403);
        }

        $alert->update([
            'alertstatus_id' => AlertStatus::STATUS_ARCHIVED, // ID 3
        ]);

        return back();
    }

    // --- NUEVO: Desarchivar la alerta (Regresar a Resuelta - Estado 2) ---
    public function unarchive(Request $request, alert $alert)
    {
        if ($alert->company_id !== $request->user()->company_id) {
            abort(403);
        }

        $alert->update([
            'alertstatus_id' => AlertStatus::STATUS_RESOLVED, // ID 2
        ]);

        return back();
    }

    // --- MODIFICADO: "Eliminar" la alerta (Estado 4) ---
    // No borramos el registro, solo cambiamos el estado.
    public function destroy(Request $request, alert $alert)
    {
        // dd('Eliminar alerta ID: ' . $alert->id);


        if ($alert->company_id !== $request->user()->company_id) {
            abort(403);
        }

        $alert->update([
            'alertstatus_id' => AlertStatus::STATUS_DELETED, // ID 4
        ]);

        return back();
    }

    // Método para obtener TODO el historial sin límites
    public function getHistory(Request $request)
    {
        $alerts = alert::query()
            ->with(['alertType', 'alertStatus']) // Asegúrate de usar los nombres de relación correctos de tu modelo
            ->where('company_id', $request->user()->company_id)
            // Aquí NO ponemos límites, queremos todo
            ->orderByDesc('created_at')
            ->get();

        return response()->json($alerts);
    }
}
