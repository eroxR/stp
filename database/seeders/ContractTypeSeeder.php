<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContractType::insert([
            ['description_typeContract' => 'Contrato para transporte de estudiantes', 'contract_name' => 'Colegios','start_contract'=> 1,'contract_limit' => 2999,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1 ],
            ['description_typeContract' => 'Contrato para transporte empresarial', 'contract_name' => 'Empresas', 'start_contract'=> 3000,'contract_limit' => 4499,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
            ['description_typeContract' => 'Contrato para transporte de turistas', 'contract_name' => 'Empresa Turismo', 'start_contract'=> 4500,'contract_limit' => 5999,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
            ['description_typeContract' => 'Contrato para un grupo específico de usuarios (transporte de particulares)', 'contract_name' => 'Ocacionales', 'start_contract'=> 7000,'contract_limit' => 10000, 'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
            ['description_typeContract' => 'Contrato para Transporte de usuarios del servicio de salud', 'contract_name' => 'Usuarios de Servicios de Salud', 'start_contract'=> 6000,'contract_limit' => 6999,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
            ['description_typeContract' => 'convenio de colaboracion empresarial', 'contract_name' => 'Comvenio Empresarial', 'start_contract'=> 1,'contract_limit' => 0,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
            ['description_typeContract' => 'Contrato de Vinculación', 'contract_name' => 'Vinculación', 'start_contract'=> 1,'contract_limit' => 0,'company_id' => 1, 'code_company' => '000', 'branch_id' => 1],
        ]);
    }
}
