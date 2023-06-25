<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Storage;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.MataPelajaran.index', [
            'mapel' => MataPelajaran::all(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => ['required', 'string', 'max:50'],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ]);

        $mapel = MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('images')) {
            $request->validate([
                'images' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
            ]);
            $file = $request->file('images');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/mapel', $filename);

            $mapel->update([
                'images' => $filename,
            ]);
        }

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Pages.MataPelajaran.edit', [
            'data' => MataPelajaran::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_mapel' => ['required', 'string', 'max:50'],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'images' => ['nullable', 'image', 'max:2048'],
        ]);

        $mapel = MataPelajaran::findOrFail($id);

        $mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $extension = $image->getClientOriginalExtension();
            $fileName = $request->kode_mapel . '.' . $extension;
            $image->storeAs('public/mapel', $fileName);

            $mapel->update([
                'image' => $fileName,
            ]);
        }

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        if ($mapel->image && file_exists(storage_path('app/public/mapel/' . $mapel->image))) {
            Storage::delete('public/mapel/' . $mapel->image);
        }
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus');
    }
}
