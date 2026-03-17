<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproductAndServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productandservice_description' => 'required|string|max:120',
            'supplier_category' => 'nullable|exists:supplier_categories,id',
            'visibility' => 'required|in:0,1',
        ];
    }
}
