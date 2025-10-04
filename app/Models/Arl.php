<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Arl extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ArlFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos
    public function historical_arl()
    {
        return $this->hasMany('App\Models\historical_arl');
    }

    protected $fillable = [
        'description_arl'

    ];
}
