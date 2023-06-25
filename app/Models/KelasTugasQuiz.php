<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasTugasQuiz extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas_tugas_quiz';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'kelas_id');
    }

    public function tugasQuiz()
    {
        return $this->belongsTo(TugasQuiz::class, 'tugas_quiz_id');
    }
}
