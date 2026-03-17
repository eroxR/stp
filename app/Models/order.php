<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class order extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa con la tabla companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //relación uno a muchos inversa con la tabla branches
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected $fillable = [
        'consecutive_order',
        'order_date',
        'requester_name',
        'requester_phone',
        'requester_email',
        'order_reason',
        'order_status',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
