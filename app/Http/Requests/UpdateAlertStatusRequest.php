<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlertStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del registro actual para ignorarlo en la validación unique
        $id = $this->alert_status->id;

        return [
            'code' => 'required|integer|unique:alert_statuses,code,' . $id,
            'name' => 'required|string|max:20',
            'icon_description' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'visibility' => 'required|in:0,1',
        ];
    }
}
