<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LicenseCategory extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\LicenseCategoryFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


        //relación uno a uno
    public function driver(){
        return $this->hasMany('App\Models\driver');
    }

    protected $fillable = [
        'code_licenseCategory', //{codigo_categoria_licencia} codigo de la categoria de la licencia de conduccion
        'description_licenseCategory', //{descripcion_categoria_licencia} descripcion nombre de la categoria de la licencia de conduccion
    ];
}
