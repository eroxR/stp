<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    /** @use HasFactory<\Database\Factories\FuelTypeFactory> */
    use HasFactory;


    protected $fillable = [
        'fuel_types_description',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
    ];
}
