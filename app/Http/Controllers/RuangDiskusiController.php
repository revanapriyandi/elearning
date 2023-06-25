<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\RuangDiskusi;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\RuangDiskusiComment;

class RuangDiskusiController extends Controller
{
    public function index()
    {
        return view(
            'Pages.RuangDiskusi.index',
            [
                'data' => RuangDiskusi::with(['user', 'mapel'])->orderBy('created_at', 'desc')->paginate(10),
                'mapel' => MataPelajaran::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => ['required', 'exists:mata_pelajarans,id', 'numeric'],
            'judul' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        RuangDiskusi::create([
            'user_id' => auth()->user()->id,
            'mata_pelajaran_id' => $request->mapel,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => $request->content,
        ]);

        return redirect()->route('ruangdiskusi')->with('success', 'Ruang Diskusi berhasil dibuat');
    }

    public function show($ruangdiskusi)
    {
        $data = RuangDiskusi::with('comment')->where('slug', $ruangdiskusi)->firstOrFail();
        return view('Pages.RuangDiskusi.show', ['data' => $data]);
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'message' => ['required', 'string']
        ]);

        $data = RuangDiskusi::where('id', $id)->firstOrFail();

        $data->comment()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->message
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }
}
