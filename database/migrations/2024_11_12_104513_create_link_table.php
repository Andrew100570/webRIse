<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->unsignedBigInteger('data_id');
            $table->unsignedBigInteger('info_id');

            // Добавляем индексы на поля data_id и info_id для оптимизации JOIN-запросов
            $table->index('data_id');
            $table->index('info_id');

            // Добавляем индексы и внешние ключи для оптимизации
            $table->foreign('data_id')->references('id')->on('data')->onDelete('cascade');
            $table->foreign('info_id')->references('id')->on('info')->onDelete('cascade');

            $table->primary(['data_id', 'info_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link');
    }
};
