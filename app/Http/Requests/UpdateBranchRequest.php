<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->charge->id; // Obtener ID actual

        return [
            'area' => 'nullable|exists:work_areas,id',
            // Ignoramos el ID actual para la validación unique
            'code_charge' => 'required|string|max:5|unique:charges,code_charge,' . $id,
            'description_charge' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
