<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreproductAndServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productandservice_description' => 'required|string|max:120',
            // Puede ser nullable según tu SQL (no dice NOT NULL), pero si es obligatorio en tu lógica, pon 'required'
            'supplier_category' => 'nullable|exists:supplier_categories,id',
            'visibility' => 'required|in:0,1',
        ];
    }
}
