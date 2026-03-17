<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /** @use HasFactory<\Database\Factories\EntityFactory> */
    use HasFactory;

    //relación muchos a muchos
    public function userData()
    {
        return $this->belongsToMany('App\Models\User');
    }

    protected $casts = [
        'type_entity' => 'array',
    ];


    protected $fillable = [

        'identification',
        'nit',
        'company_name_provider',
        'commercial_reason_supplier',
        'supplier_web_page',
        'economic_activity',
        'products_and_services',
        'supplier_description',
        'supplier_email',
        'supplier_phone',
        'supplier_mobile',
        'supplier_address',
        'type_entity',
        'company_id',
        'code_company',
        'branch_id',
        'visibility',
        'company_view',
    ];
}
