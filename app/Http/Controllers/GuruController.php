<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guruData = Guru::with(['user', 'kelas', 'mapel'])->get();
        $mapelData = MataPelajaran::pluck('nama_mapel');
        $guruCount = $guruData->groupBy('mata_pelajaran_id')->map->count();

        return view('Pages.Guru.index', [
            'guru' => $guruData,
            'labels' => $mapelData,
            'guruCount' => $guruCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('Pages.Guru.create', [
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
            'role' => 'guru',
        ]);

        $user->guru()->create([
            'nip' => $request->nip,
            'mata_pelajaran_id' => $request->mata_pelajaran,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::with(['user', 'kelas', 'mapel'])->findOrFail($id);
        return view('Pages.Guru.show', [
            'data' => $guru,
            'siswa' => Siswa::with(['user', 'kelas'])->where('kelas_id', $guru->kelas_id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = Guru::with(['user', 'kelas', 'mapel'])->findOrFail($id);

        return view('Pages.Guru.edit', [
            'guru' => $guru,
            'mapel' => MataPelajaran::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'exists:mata_pelajarans,id'],
            'kelas' => ['required', 'exists:kelas,id'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,' . $guru->user_id],
            'no_hp' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);


        $guru->user()->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $guru->update([
            'nip' => $request->nip,
            'mata_pelajaran_id' => $request->mata_pelajaran,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $guru->user()->delete();
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
