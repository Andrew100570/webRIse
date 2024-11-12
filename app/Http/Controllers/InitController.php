<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

final class InitController extends Controller
{
    /**
     * Конструктор класса.
     *
     */
    public function __construct()
    {
        $this->create();
        $this->fill();
    }

    /**
     * Создает таблицу test в базе данных.
     *
     * @return void
     */
    private function create()
    {
        // Проверяем, существует ли таблица, прежде чем создавать
        if (!Schema::hasTable('test')) {
            Schema::create('test', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('age');
                $table->string('status');
                $table->enum('result', ['normal', 'success', 'fail']);
                $table->timestamps();
            });
        }
    }

    /**
     * Заполняет таблицу test случайными данными.
     *
     * @return void
     */
    private function fill()
    {
        // Проверяем, пуста ли таблица, чтобы избежать дублирования данных
        if (DB::table('test')->count() === 0) {
            $names = ['John', 'Alice', 'Bob', 'Eve', 'Charlie'];
            $statuses = ['active', 'inactive', 'pending'];
            $results = ['normal', 'success', 'fail'];

            // Генерируем и вставляем 10 случайных записей
            for ($i = 0; $i < 10; $i++) {
                DB::table('test')->insert([
                    'name' => $names[array_rand($names)],
                    'age' => rand(18, 60),
                    'status' => $statuses[array_rand($statuses)],
                    'result' => $results[array_rand($results)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Получает данные из таблицы test, где поле result имеет значения 'normal' или 'success'.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $data = DB::table('test')
            ->whereIn('result', ['normal', 'success'])
            ->get();

        return response()->json($data);
    }
}
