<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class productAndService extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ProductAndServiceFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function supplierCategory()
    {
        // Especificamos la FK 'supplier_category'
        return $this->belongsTo(SupplierCategory::class, 'supplier_category');
    }


    //relación uno a muchos inversa
    public function user()
    {
        return $this->hasMany('App\Models\user');
    }

    protected $fillable = [
        'supplier_category',
        'productandservice_description',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
        'supplier_category' => 'integer',
    ];
}
