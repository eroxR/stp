<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class alert extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AlertFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación uno a muchos inversa
    public function alertStatus()
    {
        return $this->belongsTo('App\Models\alertStatus', 'alertstatus_id');
    }

    //relación uno a muchos inversa
    public function alertType()
    {
        return $this->belongsTo('App\Models\alertType', 'alerttype_id');
    }

    //ralación uno a muchos inversa
    public function company()
    {
        return $this->belongsTo('App\Models\company');
    }

    //relación uno a muchos inversa
    public function branch()
    {
        return $this->belongsTo('App\Models\branch');
    }



    //relación polimorfica
    public function alertable()
    {
        return $this->morphTo();
    }

    // protected $casts = [
    //     'description_alert' => 'array',
    // ];

    protected $fillable = [
        'alertstatus_id',
        'alerttype_id',
        'title_alert',
        'description_alert',
        'alert_registration_date',
        'alert_attention_date',
        'alertable_id',
        'alertable_type',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
