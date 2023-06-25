<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('Pages.Kelas.index', [
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => ['required', 'string', 'max:10', 'min:3'],
            'nama_kelas' => ['required', 'string', 'min:3'],
            'kompetensi_keahlian' => ['nullable', 'string'],
        ]);

        $kelas = Kelas::create([
            'slug' => Str::slug($request->nama_kelas),
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        if ($request->hasFile('images')) {
            $request->validate([
                'images' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
            ]);

            $image = $request->file('images');
            $image->storeAs('public/kelas', $request->kode_kelas . '.' . $image->extension());
            $kelas->update([
                'image' => $request->kode_kelas . '.' . $image->extension(),
            ]);
        }

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        return view('Pages.Kelas.edit', [
            'kelas' => $kelas,
        ]);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'kode_kelas' => ['required', 'string', 'max:10', 'min:3'],
            'nama_kelas' => ['required', 'string', 'min:3'],
            'kompetensi_keahlian' => ['nullable', 'string'],
        ]);

        $kelas->update([
            'slug' => Str::slug($request->nama_kelas),
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        if ($request->hasFile('images')) {
            $request->validate([
                'images' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
            ]);

            if ($kelas->image != null) {
                unlink(storage_path('app/public/kelas/' . $kelas->image));
            }

            $image = $request->file('images');
            $image->storeAs('public/kelas', $request->kode_kelas . '.' . $image->extension());
            $kelas->update([
                'image' => $request->kode_kelas . '.' . $image->extension(),
            ]);
        }

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diubah');
    }

    public function destroy(Kelas $kelas)
    {
        if ($kelas->image != null) {
            unlink(storage_path('app/public/kelas/' . $kelas->image));
        }

        $kelas->delete();
        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus');
    }
}
