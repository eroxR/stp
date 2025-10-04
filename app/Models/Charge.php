<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Charge extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ChargeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



            //relación uno a muchos inversa
        public function user(){
            return $this->hasMany('App\Models\User');
        }

        protected $fillable = [
            'code_charge',
            'description_charge',
        ];
}
