<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // Возвращает представление для входа
    }

//    public function store(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required',
//        ]);
//
//        // Пытаемся аутентифицировать пользователя
//        if (Auth::attempt($request->only('email', 'password'))) {
//            return redirect()->intended('notes')->with('success', 'Вы успешно вошли в систему!');
//        }
//
//        return back()->withErrors([
//            'email' => 'Неверные учетные данные.',
//        ]);
//    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Пытаемся аутентифицировать пользователя
        if (Auth::attempt($request->only('email', 'password'))) {
            // Проверяем, находимся ли мы в среде тестирования
            if (app()->environment('testing')) {
                // Для тестов можно перенаправить на dashboard
                return redirect()->route('dashboard')->with('success', 'Регистрация успешна! Добро пожаловать!');
            }

            // Перенаправление для остальных сред (например, продакшн)
            return redirect()->route('dashboard')->with('success', 'Регистрация успешна! Добро пожаловать!');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }



    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Вы вышли из системы!');
    }
}
