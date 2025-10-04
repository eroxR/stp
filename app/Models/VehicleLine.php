<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VehicleLine extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleLineFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    // Relación con la marca del vehículo
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_vehicle');
    }

    // Relación con la clase del vehículo
    public function vehicleClass()
    {
        return $this->belongsTo(VehicleClass::class, 'class_vehicle');
    }

    protected $fillable = [
        'brand_vehicle',
        'line_vehicle',
    ];
}
