<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class VKController extends Controller
{
    public function redirectToVK()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function handleVKCallback()
    {
        $vkUser = Socialite::driver('vkontakte')->user();

        // Найдите пользователя или создайте нового
        $user = User::firstOrCreate(
            ['vk_id' => $vkUser->id],
            [
                'name' => $vkUser->name,
                'email' => $vkUser->email,
                'password' => bcrypt(str_random(16)), // Сгенерируйте случайный пароль
            ]
        );

        Auth::login($user);

        return redirect()->route('notes.index'); // Перенаправление на список заметок после входа
    }
}
