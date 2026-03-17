<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos inversa
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

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
        'code_branch',
        'name_branch',
        'address_branch',
        'phone_branch',
        'email_branch',
        'city_branch',
        'province_branch',
        'country_branch',
        'postal_code_branch',
        'manager_branch',
        'number_employees_branch',
        'status_branch',
        'company_id',
        'code_company'
    ];
}
