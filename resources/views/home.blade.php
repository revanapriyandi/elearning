@extends('layouts.app')

@section('content')
    @if (auth()->user()->role != 'admin')
        <div class="row">
            <div class="col-lg-8">
                <h4 class="text-white">{{ __('Halo Selamat Datang, ') }} {{ auth()->user()->nama_lengkap }}</h4>
                <p class="text-white opacity-8">
                    {{ __('Elearning adalah sebuah sistem pembelajaran yang dapat diakses secara online.') }}
                </p>
            </div>
        </div>
    @endif
    @if (auth()->user()->role == 'siswa')
        @include('partials.siswa')
    @elseif(auth()->user()->role == 'pengajar')
        @include('partials.pengajar')
    @elseif(auth()->user()->role == 'admin')
        @include('partials.adminpage')
    @endif
@endsection
