<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Province extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos inversa
    public function country()
    {
        return $this->belongsTo(Country::class, 'partner_country');
    }

    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'department_name',
        'partner_country',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
        'partner_country' => 'integer',
    ];
}
