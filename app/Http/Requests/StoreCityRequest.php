<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            // Validamos que el departamento exista (opcionalmente podrías validar que pertenezca al país, pero con exists basta por ahora)
            'associate_department' => 'required|exists:provinces,id',
            'visibility' => 'required|in:0,1',
        ];
    }
}
