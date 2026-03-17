<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->permission->id; // Obtenemos el ID

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Validar unicidad ignorando el actual
                Rule::unique('permissions')->where(function ($query) {
                    return $query->where('guard_name', $this->guard_name);
                })->ignore($id),
            ],
            'guard_name' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
