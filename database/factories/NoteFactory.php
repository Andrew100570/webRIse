<?php

namespace Database\Factories;


use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Создает пользователя автоматически
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
        ];
    }
}