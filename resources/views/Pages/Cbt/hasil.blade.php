@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">{{ $data->judul }}</h5>
                    <p class="mb-0">{!! $data->deskripsi !!}</p>
                </div>
                <div class="card-body p-3">
                    @php
                        $data2 = \App\Models\SiswaUjian::where('tugas_quiz_id', $data->id)
                            ->where('siswa_id', auth()->user()->siswa->id)
                            ->first();
                    @endphp
                    @if (!$data2->benar)
                        <div class="alert alert-info mt-3" role="alert">
                            <strong>{{ __('Perhatian') }}!</strong>
                            {{ __('Nilai akan ditampilkan di laman ini jika jawaban sudah dinilai oleh guru.') }}
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-3 col-6 text-center">
                                <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                    <h6 class="text-primary mb-0">{{ __('Jawaban Benar') }}</h6>
                                    <h4 class="font-weight-bolder"><span id="state1"
                                            countto="{{ $data2->benar }}">{{ $data2->benar }}</span></h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 text-center">
                                <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                    <h6 class="text-primary mb-0">{{ __('Jawaban Salah') }}</h6>
                                    <h4 class="font-weight-bolder"><span id="state2"
                                            countto="{{ $data2->benar }}">{{ $data2->salah }}</span></h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                                <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                    <h6 class="text-primary mb-0">{{ __('Durasi Pengerjaan') }}</h6>
                                    <h4 class="font-weight-bolder">
                                        <span class="small" id="state3"></span>
                                    </h4>
                                </div>
                            </div>

                            @push('scripts')
                                <script>
                                    var startTime = "{!! $data2->waktu_mulai !!}";
                                    var endTime = "{!! $data2->waktu_selesai !!}";

                                    function calculateDuration(startTime, endTime) {
                                        var start = new Date(startTime);
                                        var end = new Date(endTime);
                                        var duration = end - start;
                                        var hours = Math.floor(duration / (1000 * 60 * 60));
                                        var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
                                        return hours + ' jam ' + minutes + ' menit';
                                    }

                                    document.getElementById("state3").innerText = calculateDuration(startTime, endTime);
                                </script>
                            @endpush

                            @php
                                $nilai = ($data2->benar / $data->soal->count()) * 100;

                                if ($nilai >= 90) {
                                    $nilai = 'A';
                                } elseif ($nilai >= 80) {
                                    $nilai = 'B';
                                } elseif ($nilai >= 70) {
                                    $nilai = 'C';
                                } elseif ($nilai >= 60) {
                                    $nilai = 'D';
                                } else {
                                    $nilai = 'E';
                                }
                            @endphp
                            <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                                <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                    <h6 class="text-primary mb-0">{{ __('Nilai') }}</h6>
                                    <h4 class="font-weight-bolder"><span id="state4"
                                            countto="{{ $nilai }}">{{ $nilai }}</span></h4>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
