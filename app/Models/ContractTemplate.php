<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\ContractTemplateFactory> */
    use HasFactory;

    protected $fillable = [
        'template_code',
        'template_name',
        'visibility',
        'company_view'
    ];
}
