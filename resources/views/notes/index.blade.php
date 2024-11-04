@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Мои заметки</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('notes.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Содержимое:</label>
                <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Отмена</a>
        </form>

        <!-- Форма для фильтрации и поиска -->
        <form method="GET" action="{{ route('notes.index') }}" class="mb-4">
            <div class="form-group">
                <label for="search">Поиск по заметкам:</label>
                <input type="text" name="search" id="search" placeholder="Введите текст для поиска"
                       value="{{ request('search') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="tag">Фильтр по тегу:</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="">Все теги</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Сортировка по:</label>
                <select name="sort" id="sort" class="form-control">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Дате создания</option>
                    <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Дате обновления</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Заголовку</option>
                </select>
            </div>

            <div class="form-group">
                <label for="order">Порядок:</label>
                <select name="order" id="order" class="form-control">
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Применить фильтры</button>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary mt-3">Сбросить фильтры</a>
        </form>

        <!-- Таблица со списком заметок -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    <a href="{{ route('notes.index', array_merge(request()->all(), ['sort' => 'title', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Заголовок
                    </a>
                </th>
                <th>
                    <a href="{{ route('notes.index', array_merge(request()->all(), ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Дата создания
                    </a>
                </th>
                <th>
                    <a href="{{ route('notes.index', array_merge(request()->all(), ['sort' => 'updated_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Дата обновления
                    </a>
                </th>
                <th>Теги</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($notes as $note)
                <tr>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->created_at->format('d.m.Y') }}</td>
                    <td>{{ $note->updated_at->format('d.m.Y') }}</td>
                    <td>{{ $note->tags->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Заметок не найдено.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="pagination">
            {{ $notes->links() }}
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Выход</button>
        </form>

    </div>
@endsection
