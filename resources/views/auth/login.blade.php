@extends('layouts.app')

@section('contentauth')
    <div class="card">
        <div class="card-header pb-0 text-start">
            <h4 class="font-weight-bolder">Sign In</h4>
            <p class="mb-0">Enter your email or username and password to sign in</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class=" mb-3">
                    <input id="login" type="text"
                        class="form-control form-control-lg @error('login') is-invalid @enderror" name="login"
                        value="{{ old('login') }}" required autocomplete="login" autofocus
                        placeholder="{{ __('Email/Username') }}">

                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class=" mb-3">
                    <input id="password" type="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember"> {{ __('Remember Me') }}</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                        {{ __('Login') }}</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
