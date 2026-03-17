<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class passenger extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\PassengerFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos inversa
    public function contract()
    {
        return $this->belongsTo('App\Models\contract');
    }

    //relación uno a muchos
    public function identification()
    {
        return $this->belongsTo('App\Models\identification');
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
        'identification',
        'identificationcard_passenger',
        'names_lastnames',
        'contract_id',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
