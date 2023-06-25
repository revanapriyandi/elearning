@extends('layouts.app')

@section('content')
    @if (Auth::user()->role == 'siswa' || Auth::user()->role == 'admin')
        @include('Pages.RuangDiskusi.siswa', ['data' => $data, 'mapel' => $mapel]);
    @endif

    @if (Auth::user()->role == 'pengajar')
        @include('Pages.RuangDiskusi.pengajar', [
            'data' => $data,
            'mapel' => $mapel->where('id', auth()->user()->pengajar->mata_pelajaran_id),
        ]);
    @endif
@endsection
