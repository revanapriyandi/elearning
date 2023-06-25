@extends('layouts.app')

@section('content')
    <div class="row mb-10">
        <div class="col-12">
            <div class="card card-plain mb-7">
                <div class="card-body">
                    <div class="multisteps-form mb-5">
                        <div class="row">
                            <div class="col-12 col-lg-8 mx-auto my-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="multisteps-form__progress">
                                            <button class="multisteps-form__progress-btn js-active" type="button"
                                                title="{{ __('Info Pengajar') }}">
                                                <span>{{ __('Info Pengajar') }}</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button"
                                                title="{{ __('Kelas dan Mapel') }}">
                                                {{ __('Kelas dan Mapel') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                                <form class="multisteps-form__form mb-8" action="{{ route('pengajar.store') }}"
                                    method="POST">
                                    @csrf

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bolder mb-0">{{ __('About me') }}</h5>
                                        <p class="mb-0 text-sm">{{ __('Pengajar Informations') }}</p>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <label>{{ __('Nama Lengkap') }}</label>
                                                    <input
                                                        class="multisteps-form__input form-control @error('nama_lengkap') is-invalid @enderror"
                                                        type="text" placeholder="Nama Lengkap" name="nama_lengkap"
                                                        required autocomplete="nama_lengkap" autofocus
                                                        value="{{ old('nama_lengkap') }}" />
                                                    @error('nama_lengkap')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <label>{{ __('Email') }}</label>
                                                    <input
                                                        class="multisteps-form__input form-control @error('email') is-invalid @enderror"
                                                        type="email" name="email" required value="{{ old('email') }}"
                                                        placeholder="Email" />
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <label>{{ __('Nip') }}</label>
                                                    <input
                                                        class="multisteps-form__input form-control @error('nip') is-invalid @enderror"
                                                        type="number" placeholder="nip" value="{{ old('nip') }}"
                                                        name="nip" required />
                                                    @error('nip')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-6">

                                                    <label>{{ __('Jenis Kelamin') }}</label>
                                                    <select
                                                        class="multisteps-form__select form-control @error('jenis_kelamin') is-invalid @enderror"
                                                        name="jenis_kelamin" required>
                                                        <option value="" selected disabled>Select</option>
                                                        <option value="1"
                                                            @if (old('jenis_kelamin') == '1') selected @endif>
                                                            {{ __('Laki-laki') }}</option>
                                                        <option value="2"
                                                            @if (old('jenis_kelamin') == '2') selected @endif>
                                                            {{ __('Perempuan') }}</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <label>{{ __('No HP') }}</label>
                                                    <input
                                                        class="multisteps-form__input form-control @error('no_hp') is-invalid @enderror"
                                                        type="tel" name="no_hp" required value="{{ old('no_hp') }}"
                                                        placeholder="No Hp" />
                                                    @error('no_hp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label>{{ __('Alamat') }}</label>
                                                    <input
                                                        class="multisteps-form__input form-control @error('alamat') is-invalid @enderror"
                                                        name="alamat" type="text" placeholder="Alamat"
                                                        value="{{ old('alamat') }}" required />
                                                    @error('alamat')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">{{ __('Kelas dan Mata Pelajaran') }}</h5>
                                        <div class="multisteps-form__content">

                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>{{ __('Mata Pelajaran') }}</label>
                                                    <select
                                                        class="multisteps-form__select form-control @error('mata_pelajaran') is-invalid @enderror"
                                                        name="mata_pelajaran" required>
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($mapel as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (old('mata_pelajaran') == $item->id) selected @endif>
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
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>{{ __('Kelas') }}</label>
                                                    <select
                                                        class="multisteps-form__select form-control @error('kelas') is-invalid @enderror"
                                                        name="kelas" required>
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($kelas as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (old('kelas') == $item->id) selected @endif>
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
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="submit" title="Send">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.querySelector(".multisteps-form__form");
                const nextButtons = document.querySelectorAll(".js-btn-next");
                const prevButtons = document.querySelectorAll(".js-btn-prev");

                nextButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        const currentPanel = button.closest(".multisteps-form__panel");
                        const inputFields = currentPanel.querySelectorAll(
                            "input[required], select[required]");

                        let isValid = true;

                        inputFields.forEach(function(input) {
                            if (!input.value) {
                                isValid = false;
                                input.classList.add("is-invalid");
                            } else {
                                input.classList.remove("is-invalid");
                            }
                        });

                        if (!isValid) {
                            event.preventDefault();
                        } else {
                            const nextPanel = currentPanel.nextElementSibling;

                            if (nextPanel) {
                                currentPanel.classList.remove("js-active");
                                currentPanel.classList.add("js-hidden");
                                nextPanel.classList.add("js-active");
                            }
                        }
                    });
                });

                form.addEventListener("submit", function(event) {
                    const inputFields = form.querySelectorAll("input[required], select[required]");

                    let isValid = true;

                    inputFields.forEach(function(input) {
                        if (!input.value) {
                            isValid = false;
                            input.classList.add("is-invalid");
                        } else {
                            input.classList.remove("is-invalid");
                        }
                    });

                    if (!isValid) {
                        event.preventDefault();
                    }
                });

                prevButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        const currentPanel = button.closest(".multisteps-form__panel");
                        const prevPanel = currentPanel.previousElementSibling;

                        if (prevPanel) {
                            currentPanel.classList.remove("js-active");
                            currentPanel.classList.add("js-hidden");
                            prevPanel.classList.add("js-active");
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
