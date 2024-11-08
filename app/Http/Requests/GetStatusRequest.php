<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'activation' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'activation.required' => 'Activation ID is required.',
            'activation.string' => 'Activation ID must be a string.',
        ];
    }
}
