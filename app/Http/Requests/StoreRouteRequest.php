<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_route' => 'required|string|max:255|unique:routes,name_route',
            'description_route' => 'nullable|string|max:255',
            'type_route' => 'required|in:O,D,A', // O=Origen, D=Destino, A=Ambos
            'visibility' => 'required|in:0,1',
        ];
    }
}
