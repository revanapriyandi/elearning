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
        Schema::create('siswa_ujian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('tugas_quiz_id')->constrained('tugas_quizzes')->onDelete('cascade');
            $table->string('status')->default('belum')->comment('dikerjakan, belum, selesai');
            $table->integer('nilai')->nullable();
            $table->integer('benar')->nullable();
            $table->integer('salah')->nullable();
            $table->integer('kosong')->nullable();
            $table->integer('durasi')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->dateTime('waktu_dikerjakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_ujian');
    }
};
