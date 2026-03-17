<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->vehicle_brand->id; // Obtenemos el ID actual

        return [
            // Ignoramos el ID actual en la validación unique
            'code_brand_vehicle' => 'required|string|max:60|unique:vehicle_brands,code_brand_vehicle,' . $id,
            'brand_vehicle' => 'required|string|max:60',
            'visibility' => 'required|in:0,1',
        ];
    }
}
