<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function tugasQuiz()
    {
        return $this->belongsTo(TugasQuiz::class, 'tugas_quiz_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'soal_id');
    }

    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class, 'soal_id');
    }

    public function siswaUjian()
    {
        return $this->hasMany(SiswaUjian::class, 'tugas_quiz_id');
    }
}
