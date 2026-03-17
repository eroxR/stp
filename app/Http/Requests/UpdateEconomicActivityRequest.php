<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEconomicActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->economic_activity->id;

        return [
            // Ignoramos el ID actual en la validación unique
            'economicactivity_number' => 'required|string|max:255|unique:economic_activities,economicactivity_number,' . $id,
            'description_economicactivity' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'visibility' => 'required|in:0,1',
        ];
    }
}
