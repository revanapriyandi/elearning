<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Pengajar;
use App\Models\TugasQuiz;
use App\Models\MateriRead;
use App\Models\SiswaUjian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $data = MataPelajaran::all();
        $pengajar = Pengajar::where('user_id', Auth::user()->id)->first();
        if (auth()->user()->role == 'siswa') {
            $siswa = Siswa::with(['kelas'])->where('user_id', Auth::user()->id)->first();
            $mapel = explode(',', $siswa->kelas->mapel);
            $data = $data->filter(function ($item) use ($mapel) {
                return in_array($item->id, $mapel);
            });
        } else if (auth()->user()->role == 'pengajar') {
            $mapel = explode(',', $pengajar->kelas->mapel);
            $data = $data->filter(function ($item) use ($mapel) {
                return in_array($item->id, $mapel);
            });
        }

        return view('Pages.Materi.index', [
            'data' => $data,
            'pengajar' => $pengajar,
        ]);
    }

    public function show(Request $request, $id)
    {
        $data = MataPelajaran::with(['materi', 'tugasQuiz'])->find($id);

        if ($request->ajax()) {
            return response()->json([
                'data' => Materi::with(['materiRead'])->where('id', $id)->first(),
            ]);
        }
        return view('Pages.Materi.detail', [
            'data' => $data,
        ]);
    }

    public function read($id)
    {
        $data = Materi::with(['materiRead'])->find($id);
        $read = MateriRead::where('materi_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($read) {
            $read->update([
                'status' => 1,
            ]);
        } else {
            MateriRead::create([
                'materi_id' => $id,
                'user_id' => auth()->user()->id,
                'status' => 1,
            ]);
        }
        return redirect()->back();
    }

    function getMateriData($data)
    {
        $task = TugasQuiz::where('mata_pelajaran_id', $data->id)->count();
        $MateriComplete = 0;

        if ($data->materi && $data->materi->count() > 0) {
            $MateriComplete = round(
                ($data->materi->where('status', 1)->count()
                    / $data->materi->count()
                ) * 100
            );
        }

        $chartLabels = [];
        $chartData = [];
        $chartDone = [];
        if ($data->materi && $data->materi->count() > 0) {
            $done = 0;
            foreach ($data->materi as $materi) {
                $read = MateriRead::where('materi_id', $materi->id)->where('user_id', auth()->user()->id)->get();
                if ($read->count() > 0) {
                    $done += 1;
                }
                $chartLabels[] = date('D', strtotime($materi->created_at));
                $chartData[] = $data->materi->where('created_at', $materi->created_at)->count();
            }
            if ($done == $materi->count()) {
                $chartDone = [$done, 0];
            } else {
                $chartDone = [$done, $materi->count()];
            }
        } else {
            $chartLabels[] = __('Belum ada data tersedia');
            $chartData[] = 0;
            $chartDone = [0, 0];
        }

        return [
            'task' => $task,
            'MateriComplete' => $MateriComplete,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'chartDone' => $chartDone,
        ];
    }

    public function create($id)
    {
        return view('Pages.Materi.create', [
            'data' => MataPelajaran::with(['materi', 'tugasQuiz'])->find($id),
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'content' => ['nullable', 'string'],
        ]);

        $data = MataPelajaran::with(['tugasQuiz'])->find($id);

        Materi::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => $request->content,
            'file' => is_array($request->document) ? implode(',', $request->document) : $request->document,
            'mata_pelajaran_id' => $data->id,
            'user_id' => auth()->user()->id,
            'status' => $request->status ? true : false
        ]);

        if ($request->lanjut) {
            return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
        } else {
            return redirect()->route('materi.show', $data->id)->with('success', 'Materi berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('Pages.Materi.edit', [
            'data' => Materi::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'content' => ['nullable', 'string'],
        ]);

        $data = Materi::find($id);

        $data->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => $request->content,
            'file' => is_array($request->document) ? implode(',', $request->document) : $request->document,
            'status' => $request->status ? true : false
        ]);

        if ($request->lanjut) {
            return redirect()->back()->with('success', 'Materi berhasil diubah');
        } else {
            return redirect()->route('materi.show', $data->mata_pelajaran_id)->with('success', 'Materi berhasil diubah');
        }
    }

    public function destroy($id)
    {
        $data = Materi::find($id);

        if ($data->file) {
            $file = explode(',', $data->file);
            foreach ($file as $item) {
                $path = storage_path('app/public/uploads');

                if (file_exists($path)) {
                    $file = $item;
                    $file_path = $path . '/' . $file;

                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }
        }
        $data->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }

    public function deleteFile($id, $file)
    {
        $path = storage_path('app/public/uploads/' . $file);

        if (file_exists($path)) {
            unlink($path);

            $materi = Materi::find($id);
            $fileList = explode(',', $materi->file);
            $fileList = array_diff($fileList, [$file]);
            $fileList = implode(',', $fileList);

            $materi->update([
                'file' => $fileList,
            ]);

            return redirect()->back()->with('success', 'File berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
    }
}
