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
        $data = Rombel::with(['guru', 'kelas', 'tahun_ajaran'])->orderBy('created_at', 'desc')->get();
        $data = $data->map(function ($item) {
            $item->jml_siswa = Siswa::where('rombel_id', $item->id)->count();
            return $item;
        });
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
            'name' => ['required', 'string'],
            'guru_id' => ['required', 'string'],
            'kelas_id' => ['required', 'string'],
            'tahun_ajaran_id' => ['required', 'string'],
            'status' => ['required'],
            'desc' => ['nullable', 'string'],
        ]);

        $data = new Rombel();
        $data->name = $request->name;
        $data->guru_id = $request->guru_id;
        $data->kelas_id = $request->kelas_id;
        $data->tahun_ajaran_id = $request->tahun_ajaran_id;
        $data->desc = $request->desc;
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
            'name' => ['required', 'string'],
            'guru_id' => ['required', 'string'],
            'kelas_id' => ['required', 'string'],
            'tahun_ajaran_id' => ['required', 'string'],
            'status' => ['required'],
            'desc' => ['nullable', 'string'],
        ]);

        $data = Rombel::find($id);
        $data->name = $request->name;
        $data->guru_id = $request->guru_id;
        $data->kelas_id = $request->kelas_id;
        $data->tahun_ajaran_id = $request->tahun_ajaran_id;
        $data->desc = $request->desc;
        $data->status = $request->status == '1' ? true : false;
        $data->save();

        return redirect()->back()->with('success', 'Rombongan berhasil diubah');
    }

    public function show($id)
    {
        $data = Rombel::with(['guru', 'kelas', 'tahun_ajaran'])->find($id);
        $data->siswa = Siswa::with('kelas')->where('rombel_id', $id)->get();
        return view('Pages.Rombongan.show', [
            'data' => $data,
            'siswa' => Siswa::with(['user', 'tahunAjaran'])->where('rombel_id', null)->get(),
        ]);
    }

    public function destroy($id)
    {
        $data = Rombel::find($id);
        $data->delete();

        return redirect()->route('rombel')->with('success', 'Rombongan berhasil dihapus');
    }

    public function addSiswa(Request $request, $id)
    {
        $request->validate([
            'siswa' => ['required', 'array', 'exists:siswas,id'],
        ]);

        foreach ($request->siswa as $siswa) {
            $data = Siswa::find($siswa);
            $data->rombel_id = $id;
            $data->save();
        }

        return redirect()->route('rombel.show', $id)->with('success', 'Siswa berhasil ditambahkan');
    }

    public function removeSiswa($siswa)
    {
        $data = Siswa::find($siswa);
        $data->rombel_id = null;
        $data->save();

        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }
}
