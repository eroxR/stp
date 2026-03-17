<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrakeTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brake_type_description' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
