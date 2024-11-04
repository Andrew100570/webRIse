<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Разрешаем всем авторизованным пользователям отправлять запрос
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:3|max:100',
            'content' => 'required|string|min:10',
            'tags' => 'array|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.max' => 'Title cannot exceed 100 characters.',
            'content.required' => 'Content is required.',
            'content.min' => 'Content must be at least 10 characters.',
            'tags.array' => 'Tags must be an array of tag IDs.',
            'tags.exists' => 'Some of the selected tags do not exist.',
        ];
    }
}
