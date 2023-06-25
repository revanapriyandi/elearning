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
        Schema::table('jawaban_siswas', function (Blueprint $table) {
            $table->foreignId('tugas_quiz_id')->nullable()->after('id')->constrained('tugas_quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban_siswas', function (Blueprint $table) {
            $table->dropForeign(['tugas_quiz_id']);
            $table->dropColumn('tugas_quiz_id');
        });
    }
};
