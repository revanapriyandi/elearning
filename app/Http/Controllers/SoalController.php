<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Siswa;
use App\Models\Jawaban;
use App\Models\TugasQuiz;
use App\Models\SiswaUjian;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Session\Session;

class SoalController extends Controller
{
    public function soal($id)
    {
        if (request()->ajax()) {
            $soals = Soal::query();
            $soals->with(['jawaban']);
            $soals->where('tugas_quiz_id', $id);
            return DataTables::eloquent($soals)
                ->addIndexColumn()
                ->addColumn('created_at', function ($soal) {
                    return $soal->created_at->diffForHumans();
                })
                ->addColumn('pertanyaan', function ($soal) {
                    return  $soal->pertanyaan;
                })
                ->addColumn('jenis', function ($soal) {
                    return $soal->jenis == 'pilihan_ganda' ? 'Pilihan Ganda' : ($soal->jenis == 'benar_salah' ? 'Benar Salah' : 'Isian Singkat');
                })
                ->addColumn('jawaban_A', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->pilihan == 'A') {
                            return $value->text_jawaban;
                        }
                    }
                    return '-';
                })
                ->addColumn('jawaban_B', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->pilihan == 'B') {
                            return $value->text_jawaban;
                        }
                    }
                    return '-';
                })
                ->addColumn('jawaban_C', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->pilihan == 'C') {
                            return $value->text_jawaban;
                        }
                    }
                    return '-';
                })
                ->addColumn('jawaban_D', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->pilihan == 'D') {
                            return $value->text_jawaban;
                        }
                    }
                    return '-';
                })
                ->addColumn('jawaban_E', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->pilihan == 'E') {
                            return $value->text_jawaban;
                        }
                    }
                    return '-';
                })
                ->addColumn('jawaban_benar', function ($soal) {
                    foreach ($soal->jawaban as $key => $value) {
                        if ($value->is_benar == 1 && $soal->jenis == 'pilihan_ganda') {
                            return $value->pilihan . '. ' . $value->text_jawaban;
                        }
                        if ($soal->jenis == 'benar_salah') {
                            return $value->is_benar == 1 ? 'Benar' : 'Salah';
                        }
                    }
                    return '-';
                })
                ->addColumn('actions', function ($soal) {
                    return '<a href="' . route('banksoal.soal.edit', $soal->id) . '" class="btn btn-link"><span class="fa fa-edit"></span></a>
            <a href="' . route('banksoal.soal.destroy', $soal->id) . '" class="btn btn-link text-danger" onclick="event.preventDefault(); if(confirm(\'Apakah Anda yakin ingin menghapus ini?\')) document.getElementById(\'delete-soal-' . $soal->id . '\').submit();"><span class="fa fa-trash"></span></a>
            <form id="delete-soal-' . $soal->id . '" action="' . route('banksoal.soal.destroy', $soal->id) . '" method="POST" style="display: none;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
            </form>';
                })
                ->rawColumns(['actions', 'created_at', 'jenis', 'pertanyaan', 'jawaban_A', 'jawaban_B', 'jawaban_C', 'jawaban_D', 'jawaban_E', 'jawaban_benar'])
                ->toJson();
        }

        return view('Pages.Soal.Index', [
            'soal' => Soal::where('tugas_quiz_id', $id)->get(),
            'tugasQuiz' => TugasQuiz::find($id)
        ]);
    }

    public function create(Request $request, $id)
    {
        return view('Pages.Soal.Create', [
            'tugasquiz' =>  TugasQuiz::find($id),
            'jenis' => $request->get('jenis')
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => ['required'],
            'jenis' => ['required'],
        ]);

        $soal = new Soal();
        $soal->pertanyaan = $request->pertanyaan;
        $soal->jenis = $request->jenis;
        $soal->tugas_quiz_id = $id;
        $soal->save();

        if ($request->jenis == 'pilihan_ganda') {
            $mergedArray = array_combine($request->pilihan, $request->text_jawaban);
            foreach ($mergedArray as $key => $value) {
                Jawaban::create([
                    'text_jawaban' => $value,
                    'soal_id' => $soal->id,
                    'pilihan' => $key,
                    'is_benar' => $request->jawaban_benar == $key ? 1 : 0
                ]);
            }
        }

        if ($request->jenis == 'benar_salah') {
            $pilihan = ['Benar', 'Salah'];
            foreach ($pilihan as $key => $value) {
                Jawaban::create([
                    'text_jawaban' => $value,
                    'soal_id' => $soal->id,
                    'pilihan' => $value,
                    'is_benar' => $request->jawaban_benar == $value ? 1 : 0
                ]);
            }
        }

        if ($request->lanjut == 1) {
            return redirect()->back()->with('success', 'Soal berhasil ditambahkan');
        } else {
            return redirect()->route('banksoal.soal', $id)->with('success', 'Soal berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        $soal = Soal::with(['tugasQuiz', 'jawaban'])->find($id);
        return view('Pages.Soal.Edit', [
            'soal' => $soal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => ['required'],
            'jenis' => ['required'],
        ]);

        $soal = Soal::find($id);
        $soal->pertanyaan = $request->pertanyaan;
        $soal->jenis = $request->jenis;
        $soal->save();

        if ($request->jenis == 'pilihan_ganda') {
            $mergedArray = array_combine($request->pilihan, $request->text_jawaban);
            foreach ($mergedArray as $key => $value) {
                Jawaban::updateOrCreate([
                    'soal_id' => $soal->id,
                    'pilihan' => $key,
                ], [
                    'text_jawaban' => $value,
                    'is_benar' => $request->jawaban_benar == $key ? 1 : 0
                ]);
            }
        }

        if ($request->jenis == 'benar_salah') {
            $pilihan = ['Benar', 'Salah'];
            foreach ($pilihan as $key => $value) {
                Jawaban::updateOrCreate([
                    'soal_id' => $soal->id,
                ], [
                    'is_benar' => $request->jawaban_benar == 'Benar' ? 1 : 0,
                    'pilihan' => $value,
                    'text_jawaban' => '-'
                ]);
            }
        }

        return redirect()->route('banksoal.soal', $soal->tugas_quiz_id)->with('success', 'Soal berhasil diupdate');
    }

    public function destroy($id)
    {
        $soal = Soal::find($id);
        $soal->delete();
        return redirect()->route('banksoal.soal', $soal->tugas_quiz_id)->with('success', 'Soal berhasil dihapus');
    }

    public function nilai(Request $request, $id)
    {
        $jawaban = JawabanSiswa::where('is_benar', NULL)->get();
        $nilai = SiswaUjian::with(['siswa', 'tugasQuiz'])->where('tugas_quiz_id', $id)->get();

        return view('Pages.BankSoal.nilai', [
            'jawaban' => $jawaban,
            'nilai' => $nilai,
        ]);
    }

    public function nilaiUpdate(Request $request, $quiz, $id)
    {
        $jawaban = JawabanSiswa::find($id);

        $jawaban->is_benar = $request->as == true ? 1 : 0;
        $jawaban->is_terkoreksi = 1;
        $jawaban->save();

        $SiswaUjian = SiswaUjian::with(['tugasQuiz'])->where('siswa_id', $jawaban->siswa_id)->where('tugas_quiz_id', $quiz)->first();
        $SiswaUjian->benar = $SiswaUjian->benar + ($request->as == true ? 1 : 0);
        $SiswaUjian->salah = $SiswaUjian->salah + ($request->as == false ? 1 : 0);
        if ($SiswaUjian->tugasQuiz->jenis == 'tugas') {
            $SiswaUjian->nilai = 100;
        } else {
            $SiswaUjian->nilai = $SiswaUjian->benar * 100 / $SiswaUjian->tugasQuiz->soal->count();
        }

        $SiswaUjian->save();

        return redirect()->back()->with('success', 'Nilai berhasil diupdate');
    }
}
