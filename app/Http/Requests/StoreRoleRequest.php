<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Validación única compuesta (name + guard_name)
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('guard_name', $this->guard_name);
                }),
            ],
            'guard_name' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
