<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h1>Добро пожаловать на панель управления</h1>

<nav>
    <ul>
        <li><a href="{{ route('notes.index') }}">Мои заметки</a></li>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Выход</button>
        </form>
    </ul>
</nav>
</body>
</html>
