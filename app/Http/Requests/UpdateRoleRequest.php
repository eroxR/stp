<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->role->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('guard_name', $this->guard_name);
                })->ignore($id),
            ],
            'guard_name' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
