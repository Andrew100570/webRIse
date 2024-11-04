<?php

//namespace Tests\Feature\Auth;
//
//use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use App\Models\User;
//
//class UserRegistrationTest extends TestCase
//{
//    use RefreshDatabase;
//
//    /** @test */
//    public function user_can_register_successfully()
//    {
//        // Подготовка данных для регистрации
//        $data = [
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//            'password' => 'password',
//            'password_confirmation' => 'password',
//        ];
//
//        // Выполнение POST-запроса на регистрацию
//        $response = $this->post(route('register'), $data);
//
//        // Проверяем, что пользователь был создан
//        $this->assertDatabaseHas('users', [
//            'email' => 'test@example.com',
//        ]);
//
//        // Проверяем, что произошел редирект на нужный маршрут
//        $response->assertRedirect(route('dashboard')); // проверьте, что этот маршрут настроен
//
//        // Проверяем наличие статуса в сессии
//        $response->assertSessionHas('success', 'Регистрация успешна! Добро пожаловать!'); // проверка сообщения
//
//        // Также можно проверить, что пользователь аутентифицирован
//        $this->assertAuthenticated(); // проверка, что пользователь аутентифицирован
//    }
//}



namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Note;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_and_create_notes()
    {
        // Подготовка данных для регистрации
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Выполнение POST-запроса на регистрацию
        $response = $this->post(route('register'), $data);

        // Проверяем, что пользователь был создан
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        // Проверяем, что произошел редирект на нужный маршрут
        $response->assertRedirect(route('dashboard'));

        // Проверяем наличие статуса в сессии
        $response->assertSessionHas('success', 'Регистрация успешна! Добро пожаловать!');

        // Получаем созданного пользователя
        $user = User::where('email', 'test@example.com')->first();

        // Создаем 5 заметок для этого пользователя
        $notes = Note::factory()->count(5)->create(['user_id' => $user->id]);

        // Проверяем, что заметки были созданы в базе данных
        foreach ($notes as $note) {
            $this->assertDatabaseHas('notes', [
                'id' => $note->id,
                'user_id' => $user->id,
            ]);
        }

        // Также можно проверить, что пользователь аутентифицирован
        $this->assertAuthenticated();
    }
}

