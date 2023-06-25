@extends('layouts.app')

@section('contentauth')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">{{ __('Confirm Password') }}</div>

                <div class="col fs-5 text-end"><i class="bi bi-house-lock-fill"></i></div>
            </div>
        </div>

        <div class="card-body">
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-3">

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-0">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
