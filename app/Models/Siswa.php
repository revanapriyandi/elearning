<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
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
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kelasTugasQuiz()
    {
        return $this->hasMany(KelasTugasQuiz::class, 'kelas_id');
    }

    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class, 'siswa_id');
    }

    public function ujian()
    {
        return $this->hasMany(SiswaUjian::class, 'siswa_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'siswa_id');
    }
}
