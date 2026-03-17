<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DimensionRim extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\DimensionRimFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos 
    public function vehicle()
    {
        return $this->hasMany('App\Models\vehicle');
    }

    protected $fillable = [

        'type_rims',
        'inch',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
