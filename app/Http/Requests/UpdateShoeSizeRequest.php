<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShoeSizeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description_shoesize' => 'required|string|max:120',
            'visibility' => 'required|in:0,1',
        ];
    }
}
