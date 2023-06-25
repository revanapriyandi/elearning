@extends('layouts.app')

@section('contentauth')
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col">{{ __('Reset Password') }}</div>

                <div class="col fs-5 text-end"><i class="bi bi-house-lock-fill"></i></div>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <input id="email" type="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}"
                        autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password"
                        class="form-control form-control-lg@error('password') is-invalid @enderror"
                        placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm"
                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                            class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
