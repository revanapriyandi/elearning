<?php

namespace App\Http\Controllers;

use App\Models\KelasTugasQuiz;
use App\Models\Siswa;

class HomeController extends Controller
{
    public function index()
    {
        $ujian = null;
        $siswa = null;
        if (auth()->user()->role == 'siswa') {
            $ujian = KelasTugasQuiz::with('tugasQuiz')->where('kelas_id', auth()->user()->siswa->kelas_id)->get();
        } elseif (auth()->user()->role == 'guru') {
            $ujian = KelasTugasQuiz::with('tugasQuiz')->where('kelas_id', auth()->user()->guru->kelas_id)->get();
            $siswa = Siswa::where('kelas_id', auth()->user()->guru->kelas_id)->orderBy('updated_at', 'desc')->get();
        }
        return view('home', [
            'ujian' => $ujian,
            'siswa' => $siswa
        ]);
    }
}
