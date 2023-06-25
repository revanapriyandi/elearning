<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Siswa;
use App\Models\TugasQuiz;
use App\Models\SiswaUjian;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;

class CbtController extends Controller
{
    public function index()
    {
        $datas = TugasQuiz::with(['kelasTugasQuiz', 'mapel', 'soal'])
            ->whereHas('kelasTugasQuiz', function ($query) {
                $query->where('kelas_id', auth()->user()->siswa->kelas->id);
            })
            ->where('is_aktif', 1)
            ->get();
        return view('Pages.Cbt.Index', [
            'datas' => $datas,
            'siswaUjian' => SiswaUjian::where('siswa_id', auth()->user()->siswa->id)->get()
        ]);
    }

    public function updateUjian($id, $status = 'belum')
    {
        $data = SiswaUjian::updateOrCreate(
            [
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $id
            ],
            [
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $id,
                'waktu_mulai' => now(),
                'status' => $status,
                'waktu_dikerjakan' => now(),
            ]
        );

        if ($status == 'selesai') {
            SiswaUjian::where('siswa_id', auth()->user()->siswa->id)
                ->where('tugas_quiz_id', $id)
                ->update([
                    'waktu_selesai' => now(),
                    'waktu_dikerjakan' => now()->diffInSeconds($data->waktu_mulai),
                ]);
        }

        return redirect()->route('mod.soal', $id);
    }

    public function simpanJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban' => ['required']
        ]);

        if ($request->jenis == 'quiz') {

            $soal = Soal::where('id', $id)->first();
            if ($soal->jenis == 'pilihan_ganda' || $soal->jenis == 'benar_salah') {
                $benar = 0;
                foreach ($soal->jawaban as $key => $value) {
                    if ($value->is_benar == 1 && $value->pilihan == $request->jawaban[0]) {
                        $benar = 1;
                    }
                }
                $jawaban = JawabanSiswa::updateOrCreate([
                    'siswa_id' => auth()->user()->siswa->id,
                    'soal_id' => $id,
                ], [
                    'siswa_id' => auth()->user()->siswa->id,
                    'soal_id' => $id,
                    'pilihan_jawaban' => $request->jawaban[0],
                    'is_benar' => $benar ?? 0,
                    'is_terkoreksi' => 1,
                ]);
            }

            if ($soal->jenis == 'isian') {
                $jawaban = JawabanSiswa::updateOrCreate([
                    'siswa_id' => auth()->user()->siswa->id,
                    'soal_id' => $id,
                ], [
                    'siswa_id' => auth()->user()->siswa->id,
                    'soal_id' => $id,
                    'jawaban_soal' => $request->jawaban[0],
                ]);
            }

            if ($request->datano == $request->totalsoal || $request->datano == $request->totalsoal - 1) {
                $benar = JawabanSiswa::where('siswa_id', auth()->user()->siswa->id)->where('is_benar', 1)->count();
                $jumlah_soal = Soal::where('tugas_quiz_id', $soal->tugas_quiz_id)->count();
                SiswaUjian::updateOrCreate([
                    'siswa_id' => auth()->user()->siswa->id,
                    'tugas_quiz_id' => $soal->tugas_quiz_id,
                ], [
                    'siswa_id' => auth()->user()->siswa->id,
                    'tugas_quiz_id' => $soal->tugas_quiz_id,
                    'waktu_selesai' => now(),
                    'durasi' => '60',
                    'nilai' => ($benar / $jumlah_soal) * 100,
                    'benar' => $benar,
                    'salah' => JawabanSiswa::where('siswa_id', auth()->user()->siswa->id)->where('is_benar', 0)->count(),
                    'status' => 'selesai',
                ]);

                return redirect()->route('mod')->with('success', 'Ujian berhasil dikerjakan');
            }
        } elseif ($request->jenis == 'tugas') {

            $soal = TugasQuiz::where('id', $id)->first();
            //requesr jawaban adalah file
            $file = $request->file('jawaban');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'data_file';

            JawabanSiswa::updateOrCreate([
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $id,
            ], [
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $id,
                'jawaban_soal' => $nama_file,
            ]);
            $file->move($tujuan_upload, $nama_file);

            SiswaUjian::updateOrCreate([
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $soal->id,
            ], [
                'siswa_id' => auth()->user()->siswa->id,
                'tugas_quiz_id' => $soal->id,
                'waktu_selesai' => now(),
                'durasi' => '60',
                'status' => 'selesai',
            ]);
            return redirect()->route('mod')->with('success', 'Ujian berhasil dikerjakan');
        }

        return redirect()->route('mod.soal', [$soal->tugas_quiz_id, 'no' => $request->datano + 1]);
    }

    public function soal(Request $request, $id)
    {
        $data = TugasQuiz::where('id', $id)
            ->with(['kelasTugasQuiz', 'mapel', 'soal', 'siswaUjian' => function ($query) {
                $query->where('siswa_id', auth()->user()->siswa->id)->first();
            }])
            ->first();

        $i = $request->get('no') ?? 0;
        $soal = null;

        if ($data->jenis == 'quiz') {
            $soal = $data->soal[$i];
        }

        return view('Pages.Cbt.exam', [
            'data' => $data,
            'soal' => $soal,
        ]);
    }

    public function hasil($id)
    {
        $data = TugasQuiz::where('id', $id)
            ->with(['kelasTugasQuiz', 'mapel', 'soal', 'siswaUjian' => function ($query) {
                $query->where('siswa_id', auth()->user()->siswa->id)->first();
            }])
            ->first();

        return view('Pages.Cbt.hasil', [
            'data' => $data,
        ]);
    }
}
