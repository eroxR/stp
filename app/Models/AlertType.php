<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AlertType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AlertTypeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación uno a muchos
    public function alert()
    {
        return $this->hasMany('App\Models\alert');
    }

    protected $fillable = [
        'name',
        'description',
        'severity_level',
        'icon',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
