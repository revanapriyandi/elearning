<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        return view('Pages.Semester.index', [
            'data' => Semester::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => ['required']
        ]);

        Semester::create([
            'name' => $request->semester,
            'slug' => Str::slug($request->semester)
        ]);

        return redirect()->route('semester.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('Pages.Semester.edit', [
            'data' => Semester::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => ['required']
        ]);

        $data = Semester::findOrFail($id);
        $name = $request->semester;
        $data->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);

        return redirect()->route('semester.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Semester::findOrFail($id);
        $data->delete();

        return redirect()->route('semester.index')->with('success', 'Data berhasil dihapus');
    }
}
