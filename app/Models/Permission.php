<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use OwenIt\Auditing\Contracts\Auditable; // Si usas auditoría

class Permission extends SpatiePermission implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // Campos permitidos (incluyendo los personalizados)
    protected $fillable = [
        'name',
        'guard_name',
        'visibility',
        'company_view'
    ];

    // CAST para el campo JSON
    protected $casts = [
        'company_view' => 'array',
    ];
}
