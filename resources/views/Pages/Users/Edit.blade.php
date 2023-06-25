@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Update User') }}</h4>
            <p class="text-white opacity-8">{{ $user->nama_lengkap }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" onclick="event.preventDefault();document.getElementById('updateForm').submit();"
                class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" id="btnSubmit">
                <span id="btnText">{{ __('Update User') }}</span></button>
        </div>
    </div>
    <form class="multisteps-form__form mb-8" style="height: 408px;" action="{{ route('user.update', $user->id) }}"
        method="POST" enctype="multipart/form-data" id="updateForm">
        @csrf
        @method('PUT')
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Images</h5>
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $user->image_url }}"
                                    alt="{{ $user->nama_lengkap }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder mb-0">{{ __('Update User') }}</h5>
                        <p class="mb-0 text-sm">{{ $user->nama_lengkap }}</p>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Email') }}</label>
                                <input
                                    class="multisteps-form__input form-control @error('nama_lengkap') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Nama Lengkap') }}" autofocus name="nama_lengkap"
                                    value="{{ $user->nama_lengkap }}">
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Email') }}</label>
                                <input class="multisteps-form__input form-control @error('email') is-invalid @enderror"
                                    type="email" placeholder="{{ __('Email') }}" autofocus name="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Password') }}</label>
                                <input class="multisteps-form__input form-control @error('password') is-invalid @enderror"
                                    type="password" placeholder="{{ __('Password') }}" autofocus name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Password Confirmation') }}</label>
                                <input
                                    class="multisteps-form__input form-control @error('password_confirmation') is-invalid @enderror"
                                    type="password" placeholder="{{ __('Password Confirmation') }}" autofocus
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                <label>{{ __('Role') }}</label>
                                <select name="role" id="role"
                                    class="form-control  @error('password_confirmation') is-invalid @enderror">
                                    <option value="">{{ __('Select Role') }}</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                        {{ __('Admin') }}</option>
                                    <option value="pengajar" {{ $user->role == 'pengajar' ? 'selected' : '' }}>
                                        {{ __('Pengajar') }}</option>
                                    <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>
                                        {{ __('Siswa') }}</option>
                                </select>
                                @error('role')
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
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Loading...') }}
                                </span>
                                <span id="btnText">{{ __('Update User') }}</span>
                            </button>
                        </div>

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
    </form>
@endsection
