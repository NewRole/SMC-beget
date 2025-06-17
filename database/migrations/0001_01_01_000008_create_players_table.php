<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('table_name'); // Добавляем колонку для имени таблицы
            $table->integer('place');
            $table->string('name');
            $table->decimal('tkm', 10, 2);
            $table->integer('games_played');
            $table->integer('wins');
            $table->integer('losses');
            $table->decimal('win_rate', 5, 2);
            $table->timestamps();

            $table->index('table_name'); // Добавляем индекс для быстрого поиска
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
