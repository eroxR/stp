<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del país actual para excluirlo de la validación unique
        $id = $this->country->id;

        return [
            'code_country' => 'required|string|max:3|unique:countries,code_country,' . $id,
            'country_name' => 'required|string|max:60',
            'visibility' => 'required|in:0,1',
        ];
    }
}
