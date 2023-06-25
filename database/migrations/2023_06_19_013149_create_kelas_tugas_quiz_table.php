<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelas_tugas_quiz', function (Blueprint $table) {
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('tugas_quiz_id')->nullable();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('tugas_quiz_id')->references('id')->on('tugas_quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_tugas_quiz');
    }
};
