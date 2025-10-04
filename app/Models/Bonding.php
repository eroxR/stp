<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bonding extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BondingFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


          //relación uno a muchos inversa
        public function user(){
            return $this->hasMany('App\Models\User');
        }

        protected $fillable = [
            'bonding_type_description'
        ];
}
