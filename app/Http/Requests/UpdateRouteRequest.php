<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route->id;

        return [
            // Ignorar ID actual para unique
            'name_route' => 'required|string|max:255|unique:routes,name_route,' . $id,
            'description_route' => 'nullable|string|max:255',
            'type_route' => 'required|in:O,D,A',
            'visibility' => 'required|in:0,1',
        ];
    }
}
