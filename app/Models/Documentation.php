<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Documentation extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\DocumentationFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación muchos a uno con la tabla companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //relación muchos a uno con la tabla branches
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected $fillable = [
        'document_name',
        'document_path',
        'document_type',
        'document_size',
        'document_extension',
        'document_description',
        'company_id',
        'code_company',
        'branch_id',
    ];
}
