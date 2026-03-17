<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ShoeSize extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ShoeSizeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos con el usuario
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'description_shoesize',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
