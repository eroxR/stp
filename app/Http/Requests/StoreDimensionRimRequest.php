<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDimensionRimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_rims' => 'required|string|max:120',
            'inch' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
