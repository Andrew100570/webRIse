<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetSmsRequest extends FormRequest
{
    /**
     * Определяет, может ли текущий пользователь выполнять данный запрос.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;  // Предположим, что вы хотите разрешить всем пользователям выполнять этот запрос
    }

    /**
     * Правила валидации для данного запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'activation' => [
                'required',            // Обязательное поле
                'string',              // Должно быть строкой
                Rule::in(['getSms'])   // Должно быть равно 'getSms'
            ],
        ];
    }

    /**
     * Сообщения для валидации.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'activation.required' => 'Activation ID is required.',
            'activation.string' => 'Activation ID must be a string.',
            'activation.in' => 'Activation ID must be "getSms".', // Сообщение для поля, если значение не "getSms"
        ];
    }
}
