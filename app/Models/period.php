<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class period extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\PeriodFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'name_period',
        'days_period',
        'visibility',
        'company_view'
    ];
}
