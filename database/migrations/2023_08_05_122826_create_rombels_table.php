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
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('siswa_id')->nullable()->constrained('siswas')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajarans')->onDelete('cascade');
            $table->integer('jumlah_siswa')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
