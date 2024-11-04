<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Note;

class DeleteNoteRequest extends FormRequest
{
    public function authorize()
    {
        // Проверка, что текущий пользователь является автором заметки
        $note = $this->route('note');
        return $note && $this->user()->id === $note->user_id;
    }

    public function rules()
    {
        return [
            // Правила валидации здесь не требуются, так как мы просто удаляем заметку
        ];
    }

    public function messages()
    {
        return [
            'authorized' => 'You do not have permission to delete this note.',
        ];
    }
}
