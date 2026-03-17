<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contract_name' => 'required|string|max:120',
            'description_typecontract' => 'nullable|string|max:120',
            'start_contract' => 'nullable|integer|min:0',
            'contract_limit' => 'nullable|integer|gte:start_contract', // gte: Mayor o igual que inicio
            'visibility' => 'required|in:0,1',
        ];
    }
}
