@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">{{ __('Jawaban Perlu dikoreksi') }}</h5>
                            <p class="text-sm mb-0">
                                {{ __('Jawaban Siswa') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableSoal">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Siswa') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Jawaban') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-weight-normal" style="text-align: middle;">
                                @foreach ($jawaban->where('tugas_quiz_id', request()->jenis == 'tugas' ? request()->id : null) as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->siswa->user->nama_lengkap }}<br>
                                            <small>{{ $item->siswa->nis }}</small><br />
                                            <strong>{{ $item->siswa->kelas->nama_kelas }}</strong>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ asset('data_file/' . $item->jawaban_soal) }}">{!! $item->jawaban_soal !!}</a>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="{{ route('banksoal.soal.update.nilai', ['id' => $item->id, 'quiz' => request()->id, 'as' => true]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <span class="btn-inner--icon"><i
                                                                class="ni ni-check-bold"></i></span>
                                                    </a>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{ route('banksoal.soal.update.nilai', ['id' => $item->id, 'quiz' => request()->id, 'as' => false]) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <span class="btn-inner--icon"><i
                                                                class="ni ni-fat-remove"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">{{ __('Nilai Siswa') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableSoal">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Siswa') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Nilai') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-weight-normal" style="text-align: middle;">
                                @foreach ($nilai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->siswa->user->nama_lengkap }}<br>
                                            <small>{{ $item->siswa->nis }}</small><br />
                                            <strong>{{ $item->siswa->kelas->nama_kelas }}</strong>
                                        </td>
                                        <td>
                                            {{ $item->nilai }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
