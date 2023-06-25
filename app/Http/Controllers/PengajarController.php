<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajarData = Pengajar::with(['user', 'kelas', 'mapel'])->get();
        $mapelData = MataPelajaran::pluck('nama_mapel');
        $pengajarCount = $pengajarData->groupBy('mata_pelajaran_id')->map->count();

        return view('Pages.Pengajar.index', [
            'pengajar' => $pengajarData,
            'labels' => $mapelData,
            'pengajarCount' => $pengajarCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('Pages.Pengajar.create', [
            'mapel' => MataPelajaran::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'exists:mata_pelajarans,id'],
            'kelas' => ['required', 'exists:kelas,id'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'no_hp' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'pengajar',
        ]);

        $user->pengajar()->create([
            'nip' => $request->nip,
            'mata_pelajaran_id' => $request->mata_pelajaran,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajar = Pengajar::with(['user', 'kelas', 'mapel'])->findOrFail($id);
        return view('Pages.Pengajar.show', [
            'data' => $pengajar,
            'siswa' => Siswa::with(['user', 'kelas'])->where('kelas_id', $pengajar->kelas_id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajar = Pengajar::with(['user', 'kelas', 'mapel'])->findOrFail($id);

        return view('Pages.Pengajar.edit', [
            'pengajar' => $pengajar,
            'mapel' => MataPelajaran::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengajar = Pengajar::with('user')->findOrFail($id);

        $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'exists:mata_pelajarans,id'],
            'kelas' => ['required', 'exists:kelas,id'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,' . $pengajar->id],
            'no_hp' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);


        $pengajar->user()->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $pengajar->update([
            'nip' => $request->nip,
            'mata_pelajaran_id' => $request->mata_pelajaran,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengajar = Pengajar::with('user')->findOrFail($id);

        $pengajar->user()->delete();
        $pengajar->delete();

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil dihapus');
    }
}
