<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pvd extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\PvdFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'permit_id',
        'plate_vehicle',
        'vehicle_type',
        'brand_vehicle',
        'model_vehicle',
        'side_vehicle',
        'card_operation',
        'expiration_card_operation',
        'secure_end_date',
        'technomechanical_end_date',
        'expiration_preventive',
        'driver_names_lastnames',
        'document_number',
        'license_number',
        'expiration_license'
    ];
}
