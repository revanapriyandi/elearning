<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        return view('Pages.TahunAjaran.index', [
            'data' => TahunAjaran::all()
        ]);
    }

    public function edit($id)
    {
        return view('Pages.TahunAjaran.edit', [
            'data' => TahunAjaran::findOrFail($id)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun1' => ['required', 'max:20'],
            'tahun2' => ['required', 'max:20'],
            'semester' => ['required', 'in:genap,ganjil'],
            'status' => ['required', 'in:0,1']
        ]);

        // Check if status is 1 and there is already an active data
        if ($request->status == 1 && TahunAjaran::where('status', 1)->exists()) {
            TahunAjaran::where('status', 1)->update(['status' => 0]);
        }

        $name = $request->tahun1 . '/' . $request->tahun2;
        TahunAjaran::create([
            'name' => $name,
            'semester' => $request->semester,
            'status' => $request->status
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun1' => ['required', 'max:20'],
            'tahun2' => ['required', 'max:20'],
            'semester' => ['required', 'in:genap,ganjil'],
            'status' => ['required', 'in:0,1']
        ]);

        $data = TahunAjaran::findOrFail($id);

        if ($request->status == 1 && TahunAjaran::where('status', 1)->exists()) {
            TahunAjaran::where('status', 1)->update(['status' => 0]);
        }

        $name = $request->tahun1 . '/' . $request->tahun2;
        $data->update([
            'name' => $name,
            'semester' => $request->semester,
            'status' => $request->status
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $data = TahunAjaran::findOrFail($id);
        $data->delete();

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil dihapus');
    }
}
