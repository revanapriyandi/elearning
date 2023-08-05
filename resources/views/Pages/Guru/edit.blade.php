@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="font-weight-bolder">{{ __('Profile') }}</h5>
                    <div class="row">
                        <div class="col-12">
                            <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $guru->user->image_url }}"
                                alt="{{ $guru->user->nama_lengkap }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-lg-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder">{{ __('Informasi Guru') }}</h5>
                    <form action="{{ route('guru.update', $guru->id) }}" method="POST" id="updateForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 ">
                                <label>{{ __('Email') }}<span class="text-danger">*</span></label>
                                <input class="form-control  @error('email') is-invalid @enderror" type="text"
                                    name="email" value="{{ $guru->user->email }}" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>{{ __('Nama Lengkap') }}<span class="text-danger">*</span></label>
                                <input class="form-control  @error('nama_lengkap') is-invalid @enderror" type="text"
                                    name="nama_lengkap" value="{{ $guru->user->nama_lengkap }}" autofocus>
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 ">
                                <label>{{ __('Nip') }}<span class="text-danger">*</span></label>
                                <input class="form-control  @error('nip') is-invalid @enderror" type="number"
                                    name="nip" value="{{ $guru->nip }}">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Kelas') }}<span class="text-danger">*</span></label>
                                <select name="kelas" id="kelas"
                                    class="form-control @error('kelas') is-invalid @enderror">
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $guru->kelas_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Mata Pelajaran') }}<span class="text-danger">*</span></label>
                                <select name="mata_pelajaran" id="mata_pelajaran"
                                    class="form-control @error('mata_pelajaran') is-invalid @enderror">
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $guru->mata_pelajaran_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_mapel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mata_pelajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Jenis Kelamin') }}<span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="L" {{ $guru->user->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P" {{ $guru->user->jenis_kelamin == 'P' ? 'selected' : '' }}>
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
                                <input class="form-control  @error('tempat_lahir') is-invalid @enderror" type="text"
                                    name="tempat_lahir" value="{{ $guru->tempat_lahir }}">
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
                                    name="tanggal_lahir" min="1997-01-01" max="2030-12-31"
                                    value="{{ date('Y-m-d', strtotime($guru->user->tanggal_lahir)) }}">

                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>{{ __('Nomor Hp') }}<span class="text-danger">*</span></label>
                                <input class="form-control  @error('no_hp') is-invalid @enderror" type="tel"
                                    pattern="^\d{13}$" name="no_hp" value="{{ $guru->user->no_hp }}">
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
                                <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" rows="3">{{ $guru->user->alamat }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="{{ __('Submit') }}" onclick="submitForm(event)" id="btnSubmit">
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    {{ __('Loading...') }}
                                </span>
                                <span id="btnText">{{ __('Update Data') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
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
