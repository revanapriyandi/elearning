@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="font-weight-bolder">{{ __('Profile') }}</h5>
                    <div class="row">
                        <div class="col-12">
                            <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $data->user->image_url }}"
                                alt="{{ $data->user->nama_lengkap }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-lg-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder">{{ __('Informasi Pengajar') }}</h5>
                    <div class="row">
                        <div class="col-12 ">
                            <label>{{ __('Email') }}</label>
                            <input class="form-control  @error('email') is-invalid @enderror" type="text" disabled
                                name="email" value="{{ $data->user->email }}" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>{{ __('Nama Lengkap') }}</label>
                            <input class="form-control  @error('nama_lengkap') is-invalid @enderror" disabled type="text"
                                name="nama_lengkap" value="{{ $data->user->nama_lengkap }}" autofocus>
                            @error('nama_lengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 ">
                            <label>{{ __('Nip') }}</label>
                            <input class="form-control  @error('nip') is-invalid @enderror" disabled type="number"
                                name="nip" value="{{ $data->nip }}">
                            @error('nip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>{{ __('Mata Pelajaran') }}</label>
                            <select disabled name="mata_pelajaran" id="mata_pelajaran"
                                class="form-control @error('mata_pelajaran') is-invalid @enderror">
                                <option value="{{ $data->mata_pelajara_id }}" selected>
                                    {{ $data->mapel->nama_mapel }}
                                </option>
                            </select>
                            @error('mata_pelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>{{ __('Kelas') }}</label>
                            <select name="kelas" disabled id="kelas"
                                class="form-control @error('kelas') is-invalid @enderror">
                                <option value="{{ $data->kelas_id }}" selected>
                                    {{ $data->kelas->nama_kelas }}
                                </option>
                            </select>
                            @error('kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>{{ __('Jenis Kelamin') }}</label>
                            <select name="jenis_kelamin" disabled id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="L" {{ $data->user->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ $data->user->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>{{ __('Tempat Lahir') }}</label>
                            <input disabled class="form-control  @error('tempat_lahir') is-invalid @enderror" type="text"
                                name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>{{ __('Tanggal Lahir') }}</label>
                            <input class="form-control @error('tanggal_lahir') is-invalid @enderror" type="date"
                                name="tanggal_lahir" min="1997-01-01" disabled max="2030-12-31"
                                value="{{ date('Y-m-d', strtotime($data->user->tanggal_lahir)) }}">

                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>{{ __('Nomor Hp') }}</label>
                            <input class="form-control  @error('no_hp') is-invalid @enderror" type="tel"
                                pattern="^\d{13}$" name="no_hp" disabled value="{{ $data->no_hp }}">
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ">
                            <label>{{ __('Alamat') }}</label>
                            <textarea class="form-control  @error('alamat') is-invalid @enderror" disabled name="alamat" rows="3">{{ $data->user->alamat }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $data->kelas->nama_kelas }}</h4>
                    <p>{{ __('Siswa') }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="DataTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Nama Lengkap') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Nis') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Kelas') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Email') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Created At') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $item->user->image_url }}" class="avatar avatar-sm me-3"
                                                        alt="{{ $item->user->nama_lengkap }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->user->nama_lengkap }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $item->nis }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">{{ $item->kelas->nama_kelas }}</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-secondary mb-0 text-sm"><a href="#" class="__cf_email__"
                                                    #>[{{ $item->user->email }}]</a>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-sm">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
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
    @push('scripts')
        <script>
            const dataTableBasic = new simpleDatatables.DataTable(
                "#DataTable", {
                    searchable: true,
                    fixedHeight: true,
                }
            );

            function submitForm(event) {
                event.preventDefault();

                var form = document.getElementById('updateForm');
                var btnSubmit = document.getElementById('btnSubmit');
                var btnText = document.getElementById('btnText');
                var btnLoading = document.getElementById('btnLoading');

                btnSubmit.disabled = true;
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');

                form.submit();
            }
        </script>
    @endpush
@endsection
