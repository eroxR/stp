<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChargeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'area' => 'nullable|exists:work_areas,id', // Validar que el área exista
            'code_charge' => 'required|string|max:5|unique:charges,code_charge',
            'description_charge' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
