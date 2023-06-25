<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasQuiz extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelasTugasQuiz()
    {
        return $this->hasMany(KelasTugasQuiz::class, 'tugas_quiz_id');
    }
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, 'tugas_quiz_id');
    }

    public function siswaUjian()
    {
        return $this->hasMany(SiswaUjian::class, 'tugas_quiz_id');
    }
}
