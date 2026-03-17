<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EducationalLevel extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\EducationalLevelFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //relación uno a muchos

    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    protected $fillable = [
        'description_leveleducation',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
