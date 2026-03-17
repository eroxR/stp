<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenseCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Validamos unicidad
            'code_licensecategory' => 'required|string|max:4|unique:license_categories,code_licensecategory',
            'description_licensecategory' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
