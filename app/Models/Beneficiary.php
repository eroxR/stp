<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Beneficiary extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BeneficiaryFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación muchos a muchos polimorfica
    public function beneficiary()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    protected $fillable = [
        'full_name',
        'identificationcard',
        'beneficiaryType',
        'user_id',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
