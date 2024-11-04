<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Note;


class NotePolicy
{
    use HandlesAuthorization;

    // Проверка права на обновление заметки
    public function update(User $user, Note $note)
    {
        return $user->id === $note->user_id; // Пользователь может обновлять только свои заметки
    }

    // Проверка права на удаление заметки
    public function delete(User $user, Note $note)
    {
        return $user->id === $note->user_id; // Пользователь может удалять только свои заметки
    }
}
