<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Inspection extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\InspectionFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //realación muchos a uno con Category
    public function category()
    {
        return $this->belongsTo(InspectionCategory::class, 'category_id');
    }

    protected $fillable = [
        'name_description',
        'category_id',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
        'category_id' => 'integer',
    ];
}
