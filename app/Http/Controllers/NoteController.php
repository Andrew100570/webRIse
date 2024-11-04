<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Requests\DeleteNoteRequest;
use App\Http\Requests\IndexNoteRequest;

class NoteController extends Controller
{
    public function index(IndexNoteRequest $request)
    {
        // Получаем заметки текущего пользователя
        $query = Note::with('tags')->where('user_id', auth()->id());

        // Поиск по содержимому заметки
        if ($request->filled('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        // Фильтрация по тегу
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        // Параметры сортировки и направления
        $validSortFields = ['created_at', 'title', 'updated_at'];
        $sortField = in_array($request->get('sort'), $validSortFields) ? $request->get('sort') : 'created_at';
        $sortOrder = $request->get('order') === 'asc' ? 'asc' : 'desc';

        // Пагинация
        $notes = $query->orderBy($sortField, $sortOrder)
            ->paginate($request->get('per_page', 10))
            ->withQueryString();

        // Получаем все теги для передачи в представление
        $tags = Tag::all(); // Добавляем получение всех тегов

        // Возвращаем представление с заметками и тегами
        return view('notes.index', compact('notes', 'tags')); // Передаем заметки и теги
    }

    public function create()
    {
        $tags = Tag::all(); // Получаем все теги из базы данных
        return view('notes.create', compact('tags')); // Передаем теги в представление
    }


    public function store(StoreNoteRequest $request)
    {
        // Создаем заметку с валидацией
        $note = $request->user()->notes()->create($request->validated());

        // Привязываем теги к заметке
        if ($request->has('tags')) {
            $note->tags()->attach($request->tags); // Здесь связываем теги
        }

        return redirect()->route('notes.index')->with('success', 'Заметка успешно создана!');
    }

    public function edit(Note $note)
    {
        // Проверяем, принадлежит ли заметка текущему пользователю
        $this->authorize('update', $note); // Проверка прав с использованием политики

        $tags = Tag::all(); // Получаем все теги из базы данных
        return view('notes.edit', compact('note', 'tags')); // Передаем заметку и теги в представление
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        // Проверяем, принадлежит ли заметка текущему пользователю
        $this->authorize('update', $note); // Используем политику для проверки

        $note->update($request->validated());
        $note->tags()->sync($request->tags);

        return redirect()->route('notes.index')->with('success', 'Заметка успешно обновлена!');
    }

    public function destroy(DeleteNoteRequest $request, Note $note)
    {
        // Проверяем, принадлежит ли заметка текущему пользователю
        $this->authorize('delete', $note); // Используем политику для проверки

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Заметка успешно удалена!');
    }

}
