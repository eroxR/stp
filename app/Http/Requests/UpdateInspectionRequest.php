<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_description' => 'required|string|max:255',
            'category_id' => 'required|exists:inspection_categories,id',
            'visibility' => 'required|in:0,1',
        ];
    }
}
