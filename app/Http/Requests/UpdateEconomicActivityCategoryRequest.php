<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEconomicActivityCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'division' => 'required|string|max:255',
            'groups' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
