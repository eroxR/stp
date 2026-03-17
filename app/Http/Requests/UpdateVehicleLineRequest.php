<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleLineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_vehicle' => 'required|exists:vehicle_brands,code_brand_vehicle',
            'line_vehicle' => 'required|string|max:60',
            'visibility' => 'required|in:0,1',
        ];
    }
}
