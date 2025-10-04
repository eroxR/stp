<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Driver extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\DriverFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


           //relación muchos a muchos
       public function permit(){
        return $this->belongsToMany('App\Models\permit');
    }

     //relación uno a muchos polimorfica
     public function documents(){
        return $this->morphMany('App\Models\document', 'documentable');
    }

    //relación muchos a muchos
    public function contract(){
        return $this->belongsToMany('App\Models\contract');
    }

    //relación uno a uno inversa
    public function user(){
        return $this->belongsTo('App\Models\user', 'user_id', 'user_id');
    }

    //relación muchos a muchos
    public function vehicle(){
        return $this->belongsToMany('App\Models\vehicle');
    }

    //relación uno a uno inversa
    public function licenseCategory(){
        return $this->belongsTo('App\Models\licenseCategory');
    }

    protected $fillable = [
        'user_id',
        'license_number',
        'license_category',
        'license_expiration',
        'priority_license_expiration',
        'period_license',
        'certificate_drugs_alchoolemia',
        'priority_certificate_drugs_alchoolemia',
        'period_certificate_drugs_alchoolemia',
        'SIMIT_queries',
        'priority_SIMIT_queries',
        'period_SIMIT_queries',
        'Rules_Transit',
        'priority_Rules_Transit',
        'period_Rules_Transit',
        'Defensive_driving',
        'priority_Defensive_driving',
        'period_Defensive_driving',
        'First_aid',
        'priority_First_aid',
        'period_First_aid',
        'psicosensometrico',
        'priority_psicosensometrico',
        'period_psicosensometrico',
        'Road_safety',
        'priority_Road_safety',
        'period_Road_safety',
        'driver_status',
        'linked',
        'isLinked',
        'company_id',
        'code_company',
        'branch_id'
    ];


}
