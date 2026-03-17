<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserTypeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'description_usertype', // <--- Corregido (antes tenía campos de contratos)
        'visibility',
        'company_view',
    ];

    // AGREGAR CAST
    protected $casts = [
        'company_view' => 'array',
    ];
}
