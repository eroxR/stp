<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use App\Http\Requests\StoreContractTypeRequest;
use App\Http\Requests\UpdateContractTypeRequest;
use Illuminate\Support\Facades\Auth;

class ContractTypeController extends Controller
{
    public function store(StoreContractTypeRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        // INYECCIÓN DE DATOS DE EMPRESA/SUCURSAL
        // Ajusta esto según cómo obtienes la empresa del usuario en tu sistema
        $data['company_id'] = $user->company_id ?? 1;
        $data['branch_id'] = $user->branch_id ?? 1;
        // Si tienes el código en la relación company, úsalo. Si no, pon uno por defecto.
        $data['code_company'] = $user->company->code ?? 'DEF';

        ContractType::create($data);
        return redirect()->back()->with('success', 'Tipo de contrato creado correctamente.');
    }

    public function update(UpdateContractTypeRequest $request, ContractType $contractType)
    {
        $contractType->update($request->validated());
        return redirect()->back()->with('success', 'Tipo de contrato actualizado correctamente.');
    }

    public function destroy(ContractType $contractType)
    {
        $contractType->delete();
        return redirect()->back()->with('success', 'Tipo de contrato eliminado correctamente.');
    }

}
