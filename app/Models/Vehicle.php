<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación muchos a muchos
    public function permit()
    {
        return $this->belongsToMany('App\Models\permit');
    }

    //relación muchos a muchos
    public function contract()
    {
        return $this->belongsToMany('App\Models\contract');
    }

    //relación muchos a muchos
    public function accident()
    {
        return $this->belongsToMany('App\Models\accident');
    }

    //relación uno a muchos inversa
    public function drive()
    {
        return $this->belongsTo('App\Models\user', 'driver_id');
    }

    //relación uno a muchos inversa
    public function owner()
    {
        return $this->belongsTo('App\Models\user', 'owner_vehicle');
    }

    //relación uno a muchos inversa
    public function vehicleType()
    {
        return $this->belongsTo('App\Models\vehicleType');
    }

    //relación uno a muchos inversa
    public function vehicleClass()
    {
        return $this->belongsTo('App\Models\vehicleClass');
    }
    //relación uno a muchos inversa
    public function fueltype()
    {
        return $this->belongsTo('App\Models\fueltype');
    }

    //relación uno a muchos inversa
    public function dimensionRims()
    {
        return $this->belongsTo('App\Models\dimensionRims');
    }

    //relación uno a muchos polimorfica
    public function documents()
    {
        return $this->morphMany('App\Models\document', 'documentable');
    }

    //relación uno a muchos 
    public function maintenances()
    {
        return $this->hasMany('App\Models\maintenance');
    }

    //relación uno a muchos
    public function company()
    {
        return $this->belongsTo('App\Models\company');
    }

    //relación uno a muchos
    public function branch()
    {
        return $this->belongsTo('App\Models\branch');
    }

    protected $fillable = [

        'plate_vehicle',
        'brand_vehicle',
        'vehicle_line',
        'vehicle_class',
        'fueltype',
        'registration_date',
        'model_vehicle',
        'vehicle_chassis_number',
        'engine_number',
        'property_card_number',
        'cylinder_vehicle',
        'vehicle_type',
        'side_vehicle',
        'owner_vehicle',
        'driver_id',
        'number_passenger',
        'internal_external_owner_type',
        'infrastructure_vehicle',
        'vehicle_authorization',
        'status_vehicle',
        'admission_date',
        'vehicle_pickup_date',
        'vehicle_refund',
        'service',
        'color_vehicle',
        'type_direction',
        'front_suspension',
        'rear_suspension',
        'dimension_rims',
        'rear_brake_type',
        'front_brake_type',
        'binding_contract',
        'company_id',
        'code_company',
        'branch_id',
    ];
}
