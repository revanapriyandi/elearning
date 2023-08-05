<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class RombonganController extends Controller
{
    public function index()
    {
        $data = Rombel::with(['siswa', 'guru', 'kelas', 'tahun_ajaran'])->orderBy('created_at', 'desc')->get();
        return view('Pages.Rombongan.view', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        $data = [
            'user' => User::orderBy('created_at', 'asc')->get(),
            'kelas' => Kelas::orderBy('created_at', 'asc')->get(),
            'tahun_ajaran' => TahunAjaran::orderBy('created_at', 'asc')->get(),
        ];
        return view('Pages.Rombongan.create', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => ['required', 'string'],
            'guru_id' => ['required', 'string'],
            'kelas_id' => ['required', 'string'],
            'tahun_ajaran_id' => ['required', 'string'],
            'jumlah_siswa' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $data = new Rombel();
        $data->siswa_id = $request->siswa_id;
        $data->guru_id = $request->guru_id;
        $data->kelas_id = $request->kelas_id;
        $data->tahun_ajaran_id = $request->tahun_ajaran_id;
        $data->jumlah_siswa = $request->jumlah_siswa;
        $data->status = $request->status == '1' ? true : false;
        $data->save();

        return redirect()->route('rombel')->with('success', 'Rombongan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'user' => User::orderBy('created_at', 'asc')->get(),
            'kelas' => Kelas::orderBy('created_at', 'asc')->get(),
            'tahun_ajaran' => TahunAjaran::orderBy('created_at', 'asc')->get(),
            'rombel' => Rombel::find($id),
        ];
        return view('Pages.Rombongan.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => ['required', 'string'],
            'guru_id' => ['required', 'string'],
            'kelas_id' => ['required', 'string'],
            'tahun_ajaran_id' => ['required', 'string'],
            'jumlah_siswa' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $data = Rombel::find($id);
        $data->siswa_id = $request->siswa_id;
        $data->guru_id = $request->guru_id;
        $data->kelas_id = $request->kelas_id;
        $data->tahun_ajaran_id = $request->tahun_ajaran_id;
        $data->jumlah_siswa = $request->jumlah_siswa;
        $data->status = $request->status == '1' ? true : false;
        $data->save();

        return redirect()->route('rombel')->with('success', 'Rombongan berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Rombel::find($id);
        $data->delete();

        return redirect()->route('rombel')->with('success', 'Rombongan berhasil dihapus');
    }
}
