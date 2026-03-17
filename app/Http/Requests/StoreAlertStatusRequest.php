<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlertStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|integer|unique:alert_statuses,code', // Código único
            'name' => 'required|string|max:20',
            'icon_description' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'visibility' => 'required|in:0,1',
        ];
    }
}
