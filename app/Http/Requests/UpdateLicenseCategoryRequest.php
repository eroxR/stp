<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicenseCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->license_category->id;

        return [
            // Ignoramos el ID actual
            'code_licensecategory' => 'required|string|max:4|unique:license_categories,code_licensecategory,' . $id,
            'description_licensecategory' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
