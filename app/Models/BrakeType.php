<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BrakeType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BrakeTypeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa
    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle');
    }

    protected $fillable = [
        'brake_type_description',
    ];
}
