@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Rombongan Belajar') }}</h4>
        </div>
    </div>
    <form action="{{ route('rombel.update', $data['rombel']->id) }}" method="POST" id="form">
        @csrf
        @method('PUT')

        <div class="row mt-4">

            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Data Rombel') }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Siswa') }}</label>
                                <select name="siswa_id" id="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror">
                                    @foreach ($data['user']->where('role', 'siswa') as $item)
                                        <option value="{{ $item->siswa->id }}"
                                            {{ $data['rombel']->siswa_id == $item->siswa->id ? 'selected' : '' }}>
                                            {{ $item->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>{{ __('Guru') }}</label>
                                <select name="guru_id" id="guru_id"
                                    class="form-control @error('guru_id') is-invalid @enderror">
                                    @foreach ($data['user']->where('role', 'guru') as $item)
                                        <option value="{{ $item->guru->id }}"
                                            {{ $data['rombel']->guru_id == $item->guru->id ? 'selected' : '' }}>
                                            {{ $item->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mt-4">{{ __('Kelas') }}</label>
                                <select name="kelas_id" id="kelas_id"
                                    class="form-control @error('kelas_id') is-invalid @enderror">
                                    @foreach ($data['kelas'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data['rombel']->kelas_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }} {{ $item->kode_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="mt-4">{{ __('Tahun Ajaran / Semester') }}</label>
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id"
                                    class="form-control @error('tahun_ajaran_id') is-invalid @enderror">
                                    @foreach ($data['tahun_ajaran'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data['rombel']->tahun_ajaran_id == $item->id ? 'selected' : '' }}>
                                            Semester {{ $item->semester }} ({{ $item->name }})</option>
                                    @endforeach
                                </select>
                                @error('tahun_ajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Informasi Tambahan') }}</h5>
                        <label class="mt-4">{{ __('Jumlah Siswa') }}</label>
                        <input class="multisteps-form__input form-control @error('jumlah_siswa') is-invalid @enderror"
                            type="number" name="jumlah_siswa" required
                            value="{{ $data['rombel']->jumlah_siswa ?: old('jumlah_siswa') }}"
                            placeholder="Jumlah Siswa" />
                        @error('tahun_ajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="col-12">
                            <label class="mt-4">{{ __('Status') }}</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="0" {{ $data['rombel']->status == '0' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                                <option value="1" {{ $data['rombel']->status == '1' ? 'selected' : '' }}>
                                    Aktif</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12 mt-5">
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm mb-0 me-2" type="submit"
                                        title="{{ __('Submit') }}" onclick="submitForm(event)" id="btnSubmit">
                                        <span id="btnLoading" class="d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            {{ __('Loading...') }}
                                        </span>
                                        <span id="btnText">{{ __('Update') }}</span>
                                    </button>
                                    <button class="btn btn-outline-dark btn-sm mb-0" type="button"
                                        onclick="window.history.back()" name="button">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
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
        </script>
    @endpush
@endsection
