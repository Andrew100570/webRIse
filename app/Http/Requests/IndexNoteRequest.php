<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexNoteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'nullable|string|max:100',
            'tag' => 'nullable|string|exists:tags,name', // Проверка, что тег существует в таблице tags
            'sort' => 'nullable|in:created_at,updated_at,title', // Допустимые поля для сортировки
            'order' => 'nullable|in:asc,desc', // Допустимые направления сортировки
            'page' => 'nullable|integer|min:1', // Валидация параметра пагинации
            'per_page' => 'nullable|integer|min:1|max:50' // Ограничение на количество элементов на странице
        ];
    }

    public function messages()
    {
        return [
            'search.max' => 'Search query cannot exceed 100 characters.',
            'tag.exists' => 'The selected tag does not exist.',
            'sort.in' => 'Invalid sort field.',
            'order.in' => 'Invalid order option.',
            'page.integer' => 'The page number must be an integer.',
            'page.min' => 'The page number must be at least 1.',
            'per_page.integer' => 'Items per page must be an integer.',
            'per_page.min' => 'Items per page must be at least 1.',
            'per_page.max' => 'Items per page cannot exceed 50.',
        ];
    }
}
