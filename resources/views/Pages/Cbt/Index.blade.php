@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ auth()->user()->image_url ?? 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.vecteezy.com%2Ffree-vector%2Fuser-icon&psig=AOvVaw1v2xc9SjnyiYwirMj3utIm&ust=1687817812687000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCLCtoLy53_8CFQAAAAAdAAAAABAE' }}"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->nama_lengkap }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ auth()->user()->username }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                    <i class="fa fa-clock"></i>
                                    <span class="ms-2">
                                        <span id="waktus"></span>
                                    </span>

                                    @push('scripts')
                                        <script>
                                            setInterval(() => {
                                                var now = new Date();
                                                var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now.getDay()];
                                                var tanggal = now.getDate().toString().padStart(2, '0');
                                                var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                                                    'Oktober', 'November', 'Desember'
                                                ][now.getMonth()];
                                                var tahun = now.getFullYear();
                                                var jam = now.getHours().toString().padStart(2, '0');
                                                var menit = now.getMinutes().toString().padStart(2, '0');
                                                var detik = now.getSeconds().toString().padStart(2, '0');
                                                var waktu = hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun + ' ' + jam + ':' + menit + ':' + detik;
                                                document.getElementById("waktus").textContent = waktu;
                                            }, 1000);
                                        </script>
                                    @endpush
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <section class="py-3">
            <div class="row">
                <div class="col-md-8 me-auto text-left">
                    <h5>{{ __('Daftar Ujian') }}</h5>
                    <p>{{ __('Ujian yang sedang diselenggarakan pada hari ini.') }}</p>
                </div>
            </div>
            <div class="row mt-lg-4 mt-2">
                @forelse ($datas as $data)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex ">
                                    <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                        <img src="{{ $data->mapel->image_url }}" alt="{{ $data->judul }}">
                                    </div>
                                    <div class="ms-3 my-auto ">
                                        <h6><a href="{{ route('mod.soal', $data->id) }}">{{ $data->judul }}</a></h6>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-link text-secondary ps-0 pe-2"
                                                id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-lg"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3"
                                                aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="javascript:;">Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p id="deskripsi" class="text-sm mt-3">
                                    <small>{{ strip_tags(Str::limit($data->deskripsi, 200, '...')) }}
                                    </small>
                                </p>

                                <hr class="horizontal dark">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-sm mb-0">{{ date('d F Y H:m:i', strtotime($data->waktu_mulai)) }}
                                        </h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="text-sm mb-0">
                                            {{ date('d F Y H:m:i', strtotime($data->waktu_berakhir)) }}
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    @php
                                        $currentDateTime = date('Y-m-d');
                                        $ujianMulaiDateTime = date('Y-m-d', strtotime($data->waktu_mulai));
                                        $ujianBerakhirDateTime = date('Y-m-d', strtotime($data->waktu_berakhir));
                                        $currentTime = date('H:i:s');
                                        $ujianMulaiTime = date('H:i:s', strtotime($data->waktu_mulai));
                                        $ujianBerakhirTime = date('H:i:s', strtotime($data->waktu_berakhir));
                                    @endphp

                                    <div class="col-6">
                                        @if (
                                            $ujianMulaiDateTime > $currentDateTime ||
                                                ($ujianMulaiDateTime === $currentDateTime && $ujianMulaiTime > $currentTime))
                                            <span class="badge bg-gradient-success">Ujian Belum Dimulai</span>
                                        @endif
                                    </div>

                                    <div class="col-6 text-end">
                                        @if (
                                            $ujianMulaiDateTime > $currentDateTime ||
                                                ($ujianMulaiDateTime === $currentDateTime && $ujianMulaiTime > $currentTime))
                                        @else
                                            @if ($siswaUjian->where('tugas_quiz_id', $data->id)->where('status', 'dikerjakan')->count() > 0)
                                                <a href="{{ route('mod.soal', $data->id) }}"
                                                    class="btn btn-sm btn-primary">Lanjutkan</a>
                                            @elseif ($siswaUjian->where('tugas_quiz_id', $data->id)->where('status', 'selesai')->count() > 0)
                                                @if ($data->is_terbitkan_nilai == 1)
                                                    <a href="{{ route('mod.hasil', $data->id) }}"
                                                        class="btn btn-sm btn-primary">Lihat Hasil</a>
                                                @endif
                                            @else
                                                <button type="button" onclick="confirmAlert({{ $data->id }})"
                                                    class="btn btn-sm btn-primary">Mulai Ujian</button>
                                            @endif

                                            @push('scripts')
                                                <script>
                                                    function confirmAlert(id) {
                                                        var x = confirm("Apakah Anda yakin ingin memulai ujian?");
                                                        if (x) {
                                                            window.location.href = "{{ route('mod.update', ['id' => ':id', 'status' => 'belum']) }}".replace(':id',
                                                                id);
                                                        } else {
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            @endpush
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <img src="{{ asset('storage/cbt.png') }}" alt="Ayo Ujian dengan Jujur" title="Ayo jujur dengan jujur">
                @endforelse
            </div>
        </section>
    </div>
@endsection
