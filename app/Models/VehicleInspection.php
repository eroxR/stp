<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VehicleInspection extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleInspectionFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación con el modelo Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }

    protected $casts = [
        'array_inspection' => 'array',
    ];

    protected $fillable = [
        'id_vehicle',
        'dates_start',
        'dates_end',
        'uninspected',
        'responsible',
        'mileage_start',
        'mileage_end',
        'array_inspection',
    ];
}
