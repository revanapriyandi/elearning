@extends('layouts.app')

@section('content')
    @if (Auth::user()->role == 'siswa' || Auth::user()->role == 'admin')
        @include('Pages.RuangDiskusi.siswa', ['data' => $data, 'mapel' => $mapel]);
    @endif

    @if (Auth::user()->role == 'guru')
        @include('Pages.RuangDiskusi.guru', [
            'data' => $data,
            'mapel' => $mapel->where('id', auth()->user()->guru->mata_pelajaran_id),
        ]);
    @endif
@endsection
