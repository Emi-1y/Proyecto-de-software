{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-logo"> {{ __('layout.brand') }}</div>
        <div class="auth-subtitle">{{ __('auth.login_subtitle') }}</div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 1.25rem;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}" novalidate>
            @csrf

            <div style="margin-bottom: 1rem;">
                <label for="email" class="form-label">{{ __('auth.email') }}</label>
                <input id="email" name="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="{{ __('auth.email_placeholder') }}"
                       autocomplete="email" autofocus required />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input id="password" name="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('auth.password_placeholder') }}"
                       autocomplete="current-password" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember"
                           {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                {{ __('auth.login_button') }}
            </button>
        </form>

        <hr class="auth-divider">
        <p class="auth-footer-text">
            {{ __('auth.no_account') }}
            <a href="{{ route('register') }}" style="color: var(--c-accent); font-weight: 600;">{{ __('auth.register_link') }}</a>
        </p>
    </div>
</div>
@endsection
