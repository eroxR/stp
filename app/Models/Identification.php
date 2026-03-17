<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Identification extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\IdentificationFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;




    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    //relación uno a muchos inversa
    public function contract()
    {
        return $this->hasMany('App\Models\contract');
    }

    //relación uno a muchos inversa
    public function passenger()
    {
        return $this->hasMany('App\Models\passenger');
    }

    protected $fillable = [
        'description_identification',
        'visibility',
        'company_view'
    ];

    // Cast para asegurar tipos
    protected $casts = [
        'company_view' => 'array',
    ];
}
