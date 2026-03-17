<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ResourceDocument extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ResourceDocumentFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación con la tabla companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //relación con la tabla branches
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relación solicitada con DocumentTracking
    public function documentTrackings()
    {
        // Nota: En tu SQL la FK es "resourceDocument_id"
        return $this->hasMany(DocumentTracking::class, 'resourceDocument_id');
    }


    protected $fillable = [

        'name_document',
        'company_id',
        'code_company',
        'branch_id',
        'visibility',
        'company_view'
    ];

    protected $casts = [
        'company_view' => 'array',
        'company_id' => 'integer',
        'branch_id' => 'integer',
    ];
}
