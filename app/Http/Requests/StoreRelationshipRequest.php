<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description_relationship' => 'required|string|max:45', // Límite DB
            'visibility' => 'required|in:0,1',
        ];
    }
}
