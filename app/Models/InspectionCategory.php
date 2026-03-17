<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InspectionCategory extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\InspectionCategoryFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos inversa con Inspection
    public function inspections()
    {
        // Le decimos a Eloquent que la llave foránea en la tabla 'inspections'
        // es 'category_id', no la que él asumiría por convención.
        return $this->hasMany(Inspection::class, 'category_id');
    }

    protected $fillable = [
        'name_description',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
