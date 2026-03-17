<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEconomicActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Validamos unicidad en la tabla economic_activities
            'economicactivity_number' => 'required|string|max:255|unique:economic_activities,economicactivity_number',
            'description_economicactivity' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
