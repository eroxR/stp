<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code_country' => 'required|string|max:3|unique:countries,code_country',
            'country_name' => 'required|string|max:60',
            'visibility' => 'required|in:0,1',
        ];
    }
}
