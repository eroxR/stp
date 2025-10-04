<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Document extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


        	//relación muchos a muchos polimorfica
        public function documento(){
            return $this->morphTo();
        }

        //relación uno a muchos inversa
        public function company(){
            return $this->belongsTo(Company::class);
        }

        //relación uno a muchos inversa
        public function branch(){
            return $this->belongsTo(Branch::class);
        }

         //campos asignables
        protected $fillable = [
            'documentable_id',
            'document_name',
            'extension',
            'directory',
            'documentable_type',
            'company_id',
            'code_company',
            'branch_id',
        ];
}
