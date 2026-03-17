<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvinceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_name' => 'required|string|max:120',
            'partner_country' => 'required|exists:countries,id', // Validar FK
            'visibility' => 'required|in:0,1',
        ];
    }
}
