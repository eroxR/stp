<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ContractType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ContractTypeFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


            //relación uno a muchos
        public function contract(){
            return $this->hasMany('App\Models\contract');
        } 

        protected $fillable = [
            'description_typeContract',
            'contract_name',
            'start_contract',
            'contract_limit',
            'company_id',
            'code_company',
            'branch_id'
        ];
}
