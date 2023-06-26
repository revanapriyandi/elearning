<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswaData = Siswa::with('kelas')->get();
        $kelasData = Kelas::pluck('nama_kelas');
        $siswaCount = $siswaData->groupBy('kelas_id')->map->count();

        return view('Pages.Siswa.index', [
            'siswa' => $siswaData,
            'labels' => $kelasData,
            'siswaCount' => $siswaCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Siswa.create', [
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'kelas' => ['required', 'string', 'exists:kelas,id'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'tahun_ajaran' => ['required', 'string', 'exists:tahun_ajarans,id'],
            'semester' => ['required', 'string', 'exists:semesters,id'],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'password' => bcrypt('password'),
            'jenis_kelamin' => $request->jenis_kelamin == '1' ? 'L' : 'P',
        ]);


        $siswa = Siswa::create([
            'nis' => $request->nis,
            'user_id' => $user->id,
            'kelas_id' => $request->kelas,
            'tahun_ajaran_id' => $request->tahun_ajaran,
            'semester_id' => $request->semester,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Berhasil menambahkan data siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        return view('Pages.Siswa.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $siswa->user_id],
            'nis' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'exists:kelas,id'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'tempat_lahir' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'tahun_ajaran' => ['required', 'string', 'exists:tahun_ajarans,id'],
            'semester' => ['required', 'string', 'exists:semesters,id'],
        ]);

        $siswa->nis = $request->nis;
        $siswa->kelas_id = $request->kelas;
        $siswa->tahun_ajaran_id = $request->tahun_ajaran;
        $siswa->semester_id = $request->semester;
        $siswa->save();

        $user = User::findOrFail($siswa->user_id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin == '1' ? 'L' : 'P';
        $user->save();

        return redirect()->route('siswa.index')->with('success', 'Berhasil mengubah data siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $siswa->user()->delete();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Berhasil menghapus data siswa');
    }

    public function dataNilai()
    {
        $siswa = Siswa::with(['user', 'ujian'])->get();
        return view('Pages.Siswa.dataNilai', [
            'data' => $siswa,
        ]);
    }

    public function detailNilai(string $id)
    {
        $siswa = Siswa::with(['user', 'ujian'])->findOrFail($id);
        return view('Pages.Siswa.detailNilai', [
            'data' => $siswa,
        ]);
    }
}
