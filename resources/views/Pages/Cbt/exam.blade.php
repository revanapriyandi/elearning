@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="card">
                        <label class="text-center form-control-label text-primary" for="countdown">Waktu Tersisa</label>
                        <input type="text" style="font-weight: bold; " readonly
                            class="form-control form-control-sm text-center text-primary" value=""
                            placeholder="H : i : s" id="countdown">
                    </div>
                    @php
                        $ujian = \App\Models\SiswaUjian::where('tugas_quiz_id', $data->id)
                            ->where('siswa_id', auth()->user()->siswa->id)
                            ->first();
                    @endphp

                    @push('scripts')
                        <script>
                            document.getElementById("countdown").value = "00 : 00 : 00";
                            var countDownDate;

                            if ("{{ $data->jenis }}" != 'tugas') {
                                countDownDate = new Date('{{ $ujian->waktu_mulai }}').getTime() + (60 * 60000);
                            } else {
                                countDownDate = new Date('{{ $data->waktu_mulai }}').getTime() + new Date('{{ $data->waktu_berakhir }}')
                                    .getTime();
                            }

                            var x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = countDownDate - now;
                                if ("{{ $data->jenis }}" != 'tugas') {
                                    if ("{{ $ujian->status }}" == 'dikerjakan' && distance >= 0) {
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        document.getElementById("countdown").value = hours + " : " + minutes + " : " + seconds;
                                    }
                                } else if ("{{ $data->jenis == 'tugas' }}") {
                                    if (distance >= 0) {
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        document.getElementById("countdown").value = hours + " : " + minutes + " : " + seconds;
                                    }
                                }

                                if (distance < 0) {
                                    clearInterval(x);
                                    window.location.href = "{{ route('mod.simpan', ['id' => $data->id, 'status' => 'selesai']) }}";
                                }
                            }, 1000);
                        </script>
                    @endpush

                </div>
            </div>
        </div>
    </nav>
    <div class="row mb-5">
        <div class="col-lg-3 mt-3">
            <div class="card position-sticky top-1">
                <ul class="bg-white border-radius-lg p-3">
                    <div class="row mt-3">
                        @if ($data->jenis != 'tugas')
                            @foreach ($data->soal as $index => $item)
                                @php
                                    $soalActive = $item->jawabanSiswa
                                        ->filter(function ($value, $key) {
                                            return $value->siswa_id == auth()->user()->siswa->id;
                                        })
                                        ->first();
                                @endphp
                                <div class="col-md-3 p-2">
                                    <button type="button" onclick="getSoal({{ $index }})"
                                        class="btn btn-icon-only btn-outline-secondary mb-0 d-flex align-items-center justify-content-center ms-3 @if ($index == request()->input('no', 0)) active @endif {{ $soalActive ? 'btn-success' : '' }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                        data-bs-original-title="{!! $item->pertanyaan !!}">
                                        {{ $index + 1 }}
                                    </button>
                                </div>
                            @endforeach
                            @push('scripts')
                                <script>
                                    function getSoal(no) {
                                        window.location.href = "{{ route('mod.soal', ['id' => $data->id, 'no' => '']) }}" + encodeURIComponent(no);
                                    }
                                </script>
                            @endpush
                        @else
                            <div class="col-md-12 p-2 text-center">
                                <h3>
                                    {{ $data->judul }}
                                </h3>
                                <h3>
                                    {!! $data->deskripsi !!}
                                </h3>
                            </div>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-3">
            @if ($data->jenis != 'tugas')
                @foreach ($data->siswaUjian as $cek)
                    @if ($cek->status == 'belum')
                        @include('Pages.Cbt.partials.info', ['data' => $data])
                    @elseif ($cek->status == 'dikerjakan')
                        <form action="{{ route('mod.simpan', $soal->id) }}" method="POST" id="form">
                            @csrf
                            <input type="hidden" name="datano" value="{{ request()->get('no') }}">
                            <input type="hidden" name="totalsoal" value="{{ count($data->soal) }}">
                            <input type="hidden" name="jenis" value="{{ $data->jenis }}">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ request()->get('no') + 1 }}.
                                        {{ strip_tags($soal->pertanyaan) }}
                                    </h5>
                                    <hr />
                                    <div class="row">
                                        @foreach ($soal->jawaban as $item)
                                            @php
                                                $jwb = $soal->jawabanSiswa
                                                    ->where('siswa_id', auth()->user()->siswa->id)
                                                    ->where('pilihan_jawaban', $item->pilihan)
                                                    ->first();
                                            @endphp
                                            <div class="col-md-6 shadow-card">
                                                <div class="form-check mb-3 ">
                                                    <input class="form-check-input" type="radio" name="jawaban[]"
                                                        value="{{ $item->pilihan }}" id="{{ $item->pilihan }}"
                                                        {{ $jwb && $jwb->pilihan_jawaban == $item->pilihan ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="{{ $item->pilihan }}">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-1 text-dark text-sm">{{ $item->pilihan }}</h6>
                                                            <span
                                                                class="font-weight-bold">{{ strip_tags($item->text_jawaban) }}</span>
                                                        </div>
                                                    </label>
                                                    @error('jawaban')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($soal->jenis == 'isian')
                                            <textarea name="jawaban[]" id="jawaban" cols="30" rows="10" class="form-control" required>
                                    {{ $soalActive ? $soalActive->jawaban : old('jawaban') }}
                                </textarea>
                                            @error('jawaban')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="button-row d-flex mt-4">
                                        @if (request()->get('no') == count($data->soal) || request()->get('no') == count($data->soal) - 1)
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                onclick="confirmSelesai(event)" id="btnSubmit" type="submit"
                                                title="{{ __('Selesai') }}">
                                                <span id="btnLoading" class="d-none">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    {{ __('Loading...') }}
                                                </span>
                                                <span id="btnText">{{ __('Selesai') }}</span>
                                            </button>
                                        @else
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                onclick="submitForm(event)" id="btnSubmit" type="submit"
                                                title="{{ __('Simpan') }}">
                                                <span id="btnLoading" class="d-none">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    {{ __('Loading...') }}
                                                </span>
                                                <span id="btnText">{{ __('Simpan') }}</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                        </form>
                    @endif
                @endforeach
            @else
                <form action="{{ route('mod.simpan', $data->id) }}" method="POST" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jenis" value="{{ $data->jenis }}">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $data->judul }}
                            </h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 shadow-card">
                                    <input type="file" name="jawaban" required class="form-control"
                                        accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*">
                                    @error('jawaban')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-row d-flex mt-4">

                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" onclick="submitForm(event)"
                                    id="btnSubmit" type="submit" title="{{ __('Simpan') }}">
                                    <span id="btnLoading" class="d-none">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        {{ __('Loading...') }}
                                    </span>
                                    <span id="btnText">{{ __('Simpan') }}</span>
                                </button>
                            </div>
                        </div>
                </form>
            @endif
        </div>
        @push('scripts')
            <script>
                function confirmSubmit(event) {
                    event.preventDefault();

                    if (confirm("Apakah Anda yakin ingin menyelesaikan?")) {
                        submitForm(event);
                    }
                }

                function submitForm(event) {
                    event.preventDefault();

                    var form = document.getElementById('form');
                    var btnSubmit = document.getElementById('btnSubmit');
                    var btnText = document.getElementById('btnText');
                    var btnLoading = document.getElementById('btnLoading');

                    btnSubmit.disabled = true;
                    btnText.classList.add('d-none');
                    btnLoading.classList.remove('d-none');

                    form.submit();
                }

                tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample',
                    tinycomments_mode: 'embedded',
                });
            </script>
        @endpush
    </div>
    </div>
@endsection
