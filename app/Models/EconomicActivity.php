<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EconomicActivity extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\EconomicActivityFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'economicactivity_number',
        'description_economicactivity'
    ];
}
