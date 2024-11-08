<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => 'required|string|max:2',
            'service' => 'required|string|max:10',
            'rent_time' => 'nullable|integer|min:1', // optional
        ];
    }

    public function messages(): array
    {
        return [
            'country.required' => 'Country is a required field.',
            'country.string' => 'Country must be a string.',
            'country.max' => 'Country code must be at most 2 characters.',
            'service.required' => 'Service is a required field.',
            'service.string' => 'Service must be a string.',
            'service.max' => 'Service code must be at most 10 characters.',
            'rent_time.integer' => 'Rent time must be an integer.',
            'rent_time.min' => 'Rent time must be at least 1 hour.',
        ];
    }
}
