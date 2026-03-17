<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class City extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa
    public function country()
    {
        return $this->belongsTo(Country::class, 'partner_country');
    }

    //relación uno a muchos inversa
    public function province()
    {
        return $this->belongsTo(Province::class, 'associate_department');
    }

    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'city_name',
        'partner_country',
        'associate_department',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
        'partner_country' => 'integer',
        'associate_department' => 'integer',
    ];
}
