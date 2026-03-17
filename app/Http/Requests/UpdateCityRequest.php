<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_name' => 'required|string|max:255',
            'partner_country' => 'required|exists:countries,id',
            'associate_department' => 'required|exists:provinces,id',
            'visibility' => 'required|in:0,1',
        ];
    }
}
