<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cpvd extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CpvdFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación muchos a muchos
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    protected $fillable = [
        'order_id',
        'contract_id',
        'vehicle_id',
        'permit_id',
        'user_id',
        'accident_id',
        'company_id',
        'code_company',
        'branch_id',
    ];
}
