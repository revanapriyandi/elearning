@extends('layouts.app')

@section('content')
    <section class="py-3">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-white">{{ __('Materi Pelajaran') }}</h4>
                <p class="text-white opacity-8">
                    Materi Pelajaran yang tersedia di kelas anda <br>
                </p>
            </div>
        </div>
        <div class="row mt-lg-4 mt-2">
            @foreach ($data as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="avatar avatar-xl bg-gradient-dark border-radius-md">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->nama_mapel }}">
                                </div>
                                <div class="ms-3 my-auto">
                                    <h6>
                                        <a href="{{ route('materi.show', $item->id) }}">{{ $item->nama_mapel }}</a>
                                    </h6>
                                </div>
                                <div class="ms-auto">

                                </div>
                            </div>
                            <p class="text-sm mt-3"> {!! Str::limit($item->deskripsi, 50, '...') !!} </p>
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-6">
                                    @php
                                        $materiCount = App\Models\Materi::where('mata_pelajaran_id', $item->id)->count();
                                    @endphp
                                    <h6 class="text-sm mb-0">{{ $materiCount }}</h6>
                                    <p class="text-secondary text-sm font-weight-bold mb-0">{{ __('Materi') }}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <h6 class="text-sm mb-0">{{ $item->created_at->format('d F Y') }}</h6>
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Created At</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
