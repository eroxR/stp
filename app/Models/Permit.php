<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Permit extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\PermitFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación muchos a muchos
    public function driver()
    {
        return $this->belongsToMany(driver::class);
    }

    //relación muchos a muchos
    public function vehicle()
    {
        return $this->belongsToMany(vehicle::class);
    }

    //relación uno a muchos polimorfica
    public function documents()
    {
        return $this->morphMany('App\Models\document', 'documentable');
    }

    //relación uno a muchos inversa
    public function contract()
    {
        return $this->belongsTo('App\Models\contract');
    }

    //relación uno a muchos inversa
    public function company()
    {
        return $this->belongsTo('App\Models\company');
    }

    //relación uno a muchos inversa
    public function branch()
    {
        return $this->belongsTo('App\Models\branch');
    }

    protected $fillable = [
        'contract',
        'permit_start_date',
        'permit_end_date',
        'permit_number',
        'permit_code',
        'fuec_status',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
