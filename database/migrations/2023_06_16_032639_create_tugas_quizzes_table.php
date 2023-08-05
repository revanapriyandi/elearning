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
        Schema::create('tugas_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->longText('deskripsi');
            $table->enum('jenis', ['tugas', 'quiz', 'ujian']);
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_berakhir');
            $table->boolean('is_aktif')->default(true);
            $table->boolean('is_dikoreksi')->default(false);
            $table->boolean('is_terbitkan_nilai')->default(false);
            $table->boolean('is_poin')->default(false);
            $table->boolean('is_acak_soal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_quizzes');
    }
};
