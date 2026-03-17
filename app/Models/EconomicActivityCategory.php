<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EconomicActivityCategory extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\EconomicActivityCategoryFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'division',
        'groups',
        'description',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
