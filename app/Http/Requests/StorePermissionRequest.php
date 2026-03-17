<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
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
                // Validar unicidad combinada con guard_name
                Rule::unique('permissions')->where(function ($query) {
                    return $query->where('guard_name', $this->guard_name);
                }),
            ],
            'guard_name' => 'required|string|max:255', // web, api, etc.
            'visibility' => 'required|in:0,1',
        ];
    }
}
