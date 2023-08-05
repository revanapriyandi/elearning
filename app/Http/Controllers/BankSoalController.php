<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasTugasQuiz;
use App\Models\TugasQuiz;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\SiswaUjian;
use Yajra\DataTables\Facades\DataTables;

class BankSoalController extends Controller
{
    private function generateData($jenis)
    {
        $banksoal = TugasQuiz::query();
        if (auth()->user()->role == 'guru') {
            $banksoal->where('user_id', auth()->user()->id);
        }

        $banksoal->where('jenis', $jenis == 'ujian' ? '=' : '!=', 'ujian');
        $banksoal->with(['user', 'mapel', 'kelasTugasQuiz']);

        return DataTables::eloquent($banksoal)
            ->addIndexColumn()
            ->addColumn('updated_at', function ($soal) {
                return $soal->updated_at->diffForHumans();
            })
            ->addColumn('question', function ($soal) {
                return $soal->judul;
            })
            ->addColumn('created_by', function ($soal) {
                return $soal->user->nama_lengkap;
            })
            ->addColumn('mapel', function ($soal) {
                return $soal->mapel->nama_mapel;
            })
            ->addColumn('waktu', function ($soal) {
                $waktu_mulai = strtotime($soal->waktu_mulai);
                $waktu_selesai = strtotime($soal->waktu_selesai);
                return date('d M Y H:i', $waktu_mulai) . ' - ' . date('d M Y H:i', $waktu_selesai);
            })
            ->addColumn('status', function ($soal) {
                if ($soal->is_aktif) {
                    return '<span class="badge bg-gradient-success">Aktif</span>';
                } else {
                    return '<span class="badge bg-gradient-danger">Tidak Aktif</span>';
                }
            })
            ->addColumn('actions', function ($soal) {
                return '<div class="dropdown"><button class="btn btn-sm bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Actions</button><ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"><li><a class="dropdown-item" href="' . route('banksoal.soal', $soal->id) . '">Soal</a></li><li><a class="dropdown-item" href="' . route('banksoal.soal.nilai', ['id' => $soal->id, 'jenis' => $soal->jenis]) . '">Nilai</a></li> <li><a class="dropdown-item" href="' . route('banksoal.edit', $soal->id) . '">Edit</a></li> <li><a class="dropdown-item" href="' . route('banksoal.soal.destroy', $soal->id) . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus ini?\')">Delete</a></li></ul></div>';
            })
            ->rawColumns(['actions', 'updated_at', 'status', 'question', 'created_by',  'mapel', 'waktu'])
            ->toJson();
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->generateData('non-ujian');
        }
        return view('Pages.BankSoal.index');
    }

    public function ujian()
    {
        if (request()->ajax()) {
            return $this->generateData('ujian');
        }
        return view('Pages.BankSoal.index');
    }



    public function create()
    {
        return view('Pages.BankSoal.create', [
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => ['required', 'string'],
            'jenis_ujian' => ['required', 'string'],
            'kelas' => ['required'],
            'mapel' => ['required', 'integer', 'exists:mata_pelajarans,id'],
            'waktu_mulai' => ['required', 'date'],
            'waktu_berakhir' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
        ]);

        $tugas_quiz = TugasQuiz::create([
            'slug' => Str::slug($request->nama_ujian),
            'judul' => $request->nama_ujian,
            'jenis' => $request->jenis_ujian,
            'mata_pelajaran_id' => $request->mapel,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->user()->id,
            'is_aktif' => $request->is_aktif == 'on' ? true : false,
            'is_terbitkan_nilai' => $request->is_terbitkan_nilai == 'on' ? true : false,
        ]);

        foreach ($request->kelas as $kelas) {
            if ($kelas == 'all') {
                $kelasId = Kelas::all()->pluck('id');
                foreach ($kelasId as $id) {
                    KelasTugasQuiz::create([
                        'tugas_quiz_id' => $tugas_quiz->id,
                        'kelas_id' => $id,
                    ]);
                }
            } else {
                KelasTugasQuiz::create([
                    'tugas_quiz_id' => $tugas_quiz->id,
                    'kelas_id' => $kelas,
                ]);
            }
        }
        if ($request->jenis_ujian == 'ujian') {
            return redirect()->route('banksoal.ujian')->with('success', 'Ujian berhasil dibuat');
        }
        return redirect()->route('banksoal')->with('success', 'Soal berhasil dibuat');
    }

    public function edit($id)
    {
        return view('Pages.BankSoal.edit', [
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
            'soal' => TugasQuiz::with('kelasTugasQuiz')->findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ujian' => ['required', 'string'],
            'jenis_ujian' => ['required', 'string'],
            'kelas' => ['required'],
            'mapel' => ['required', 'integer', 'exists:mata_pelajarans,id'],
            'waktu_mulai' => ['required', 'date'],
            'waktu_berakhir' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
        ]);

        $tugas_quiz = TugasQuiz::findOrFail($id);
        $tugas_quiz->update([
            'slug' => Str::slug($request->nama_ujian),
            'judul' => $request->nama_ujian,
            'jenis' => $request->jenis_ujian,
            'mata_pelajaran_id' => $request->mapel,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->user()->id,
            'is_aktif' => $request->is_aktif == 'on' ? true : false,
            'is_terbitkan_nilai' => $request->is_terbitkan_nilai == 'on' ? true : false,
        ]);

        KelasTugasQuiz::where('tugas_quiz_id', $tugas_quiz->id)->delete();

        foreach ($request->kelas as $kelas) {
            if ($kelas == 'all') {
                $kelasId = Kelas::all()->pluck('id');
                foreach ($kelasId as $id) {
                    KelasTugasQuiz::create([
                        'tugas_quiz_id' => $tugas_quiz->id,
                        'kelas_id' => $id,
                    ]);
                }
            } else {
                KelasTugasQuiz::create([
                    'tugas_quiz_id' => $tugas_quiz->id,
                    'kelas_id' => $kelas,
                ]);
            }
        }
        if ($request->jenis_ujian == 'ujian') {
            return redirect()->route('banksoal.ujian')->with('success', 'Ujian berhasil dibuat');
        }
        return redirect()->route('banksoal')->with('success', 'Soal berhasil diupdate');
    }

    public function destroy($id)
    {
        $tugas_quiz = TugasQuiz::findOrFail($id);
        $tugas_quiz->delete();

        return redirect()->back()->with('success', 'Soal berhasil dihapus');
    }
}
