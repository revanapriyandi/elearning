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
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <input id="email" type="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required placeholder="{{ __('Email Address') }}" autocomplete="email"
                        autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-0 text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
