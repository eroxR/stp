<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BloodType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BloodTypeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    protected $fillable = [
        'blood_type_description',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
