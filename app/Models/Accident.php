<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Accident extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AccidentFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación muchos a muchos
    public function driver()
    {
        return $this->belongsToMany('App\Models\driver');
    }

    //relación muchos a muchos
    public function vehicle()
    {
        return $this->belongsToMany('App\Models\vehicle');
    }

    //relación muchos a muchos
    public function company()
    {
        return $this->belongsToMany('App\Models\company');
    }

    //relación muchos a muchos
    public function branch()
    {
        return $this->belongsToMany('App\Models\branch');
    }

    protected $fillable = [
        'accident_place',
        'date_accident',
        'accident_description',
        'comparing_number',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
