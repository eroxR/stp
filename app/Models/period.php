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
        'name_period', // {nombre_periodo} nombre del periodo de vencimiento
        'days_period', // {dias_periodo} número de días del periodo de vencimiento
    ];
}
