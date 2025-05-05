<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// В файле миграции
    public function up() {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->timestamps(); // Убрали поле status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
