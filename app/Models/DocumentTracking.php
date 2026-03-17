<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTracking extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentTrackingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'resourceDocument_id',
        'name_document',
        'start_date',
        'end_date',
        'traffic_light',
        'period',
        'priority'
    ];
}
