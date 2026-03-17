<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;




    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    //relación uno a muchos inversa
    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle');
    }

    //relación uno a muchos inversa
    public function alert()
    {
        return $this->hasMany('App\Models\Alert');
    }

    //relación uno a muchos inversa
    public function maintenance()
    {
        return $this->hasMany('App\Models\Maintenance');
    }

    //relación uno a muchos inversa
    public function origin_route()
    {
        return $this->hasMany('App\Models\OriginRoute');
    }

    //relación uno a muchos inversa
    public function destination_route()
    {
        return $this->hasMany('App\Models\DestinationRoute');
    }

    //relación uno a muchos inversa
    public function documentation()
    {
        return $this->hasMany('App\Models\Documentation');
    }

    //relación uno a muchos inversa
    public function drive()
    {
        return $this->hasMany('App\Models\Driver');
    }

    //relación uno a muchos inversa
    public function resource_document()
    {
        return $this->hasMany('App\Models\ResourceDocument');
    }

    //relación uno a muchos inversa
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    //relación uno a muchos inversa
    public function contract()
    {
        return $this->hasMany('App\Models\Contract');
    }

    //relación uno a muchos inversa
    public function permit()
    {
        return $this->hasMany('App\Models\Permit');
    }

    //relación uno a muchos inversa
    public function document()
    {
        return $this->hasMany('App\Models\Document');
    }

    //relación uno a muchos inversa
    public function benficiary()
    {
        return $this->hasMany('App\Models\Beneficiary');
    }

    //relación uno a muchos inversa
    public function passenger()
    {
        return $this->hasMany('App\Models\Passenger');
    }


    protected $fillable = [
        'code_company',
        'name_company',
        'nit_company',
        'acronym_company',
        'economic_activity_code',
        'legal_representative',
        'legal_representative_identification',
        'legal_representative_document',
        'legal_representative_expedition_identificationcard',
        'address_representative_legal',
        'phone_representative_legal',
        'email_representative_legal',
        'digital_signature_legal_representative',
        'legal_nature',
        'address_company',
        'phone_company',
        'email_company',
        'website_company',
        'scope_company',
        'description_company',
        'country_company',
        'province_company',
        'city_company',
        'mission_company',
        'vision_company',
        'values_company',
        'postal_code_company',
        'number_employees',
        'number_branches',
        'status_company',
        'plans_company',
        'trial_ends_at',
        'subscription_start_at',
        'subscription_ends_at',
        'renewal_date',
    ];
}
