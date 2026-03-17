<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code_brand_vehicle' => 'required|string|max:60|unique:vehicle_brands,code_brand_vehicle',
            'brand_vehicle' => 'required|string|max:60',
            'visibility' => 'required|in:0,1',
        ];
    }
}
