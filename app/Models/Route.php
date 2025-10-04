<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Route extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\RouteFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    
    //relación con la tabla companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    //relación con la tabla branches
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

        //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\Contract');
    }

    protected $fillable = [
        'name_route',
        'description_route',
        'type_route',
        'company_id',
        'code_company',
        'branch_id',
    ];
}
