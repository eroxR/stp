<?php

namespace App\Models;

// Importamos el modelo de Spatie con un Alias
use Spatie\Permission\Models\Role as SpatieRole;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends SpatieRole implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // Definimos los campos permitidos, incluyendo los personalizados
    protected $fillable = [
        'name',
        'guard_name',
        'visibility',
        'company_view'
    ];

    // Cast para el JSON
    protected $casts = [
        'company_view' => 'array',
    ];
}
