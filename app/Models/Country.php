<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Country extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos
    public function provinces()
    {
        return $this->hasMany('App\Models\provinces');
    }

    //relación uno a muchos
    public function city()
    {
        return $this->hasMany('App\Models\city');
    }

    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'code_country',
        'country_name',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
