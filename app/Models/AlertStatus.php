<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AlertStatus extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AlertStatusFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación uno a muchos
    public function alert()
    {
        return $this->hasMany('App\Models\alert');
    }

    // Asumiendo según tus comentarios: 1=Nueva, 2=Resuelta, 3=Archivada, 4=Eliminada
    public const STATUS_NEW = 1;
    public const STATUS_RESOLVED = 2;
    public const STATUS_ARCHIVED = 3;
    public const STATUS_DELETED = 4;

    protected $fillable = [
        'description',
        'name',
        'icon_description',
        'code',
    ];
}
