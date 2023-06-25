<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::where('siswa_id', auth()->user()->siswa->id)->paginate(10);
        $presensiHariIni = Presensi::where('siswa_id', auth()->user()->siswa->id)->whereDate('created_at', Carbon::today())->first();
        return view('Pages.Presensi.index', [
            'presensi' => $presensi,
            'isWeekend' => false,
            'presensiHariIni' => $presensiHariIni
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'status' => ['required', 'in:hadir,izin,sakit']
            ]
        );

        $presensi = Presensi::create(
            [
                'siswa_id' => auth()->user()->siswa->id,
                'status' => $request->status,
                'latitude' => $request->latitude ?? '0',
                'longitude' => $request->longitude ?? '0',
                'keterangan' => $request->keterangan ?? '-',
            ]
        );

        return redirect()->back()->with('success', 'Presensi berhasil disimpan');
    }
}
