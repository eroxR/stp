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

    protected $fillable = [
        'description_statusalert',
    ];
}
