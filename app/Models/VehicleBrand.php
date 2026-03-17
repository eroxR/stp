<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VehicleBrand extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleBrandFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos con Vehicle
    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle');
    }

    protected $fillable = [
        'code_brand_vehicle',
        'brand_vehicle',
        'visibility',
        'company_view',
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
