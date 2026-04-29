{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-logo">🌿 {{ __('layout.brand') }}</div>
        <div class="auth-subtitle">{{ __('auth.register_subtitle') }}</div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 1.25rem;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.store') }}" novalidate>
            @csrf

            <div style="margin-bottom: 1rem;">
                <label for="name" class="form-label">{{ __('auth.name') }}</label>
                <input id="name" name="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="{{ __('auth.name_placeholder') }}"
                       autocomplete="name" autofocus required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="email" class="form-label">{{ __('auth.email') }}</label>
                <input id="email" name="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="{{ __('auth.email_placeholder') }}"
                       autocomplete="email" required />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input id="password" name="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('auth.password_placeholder') }}"
                       autocomplete="new-password" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password_confirmation" class="form-label">{{ __('auth.password_confirm') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="form-control"
                       placeholder="{{ __('auth.password_placeholder') }}"
                       autocomplete="new-password" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">
                {{ __('auth.register_button') }}
            </button>
        </form>

        <hr class="auth-divider">
        <p class="auth-footer-text">
            {{ __('auth.have_account') }}
            <a href="{{ route('login') }}" style="color: var(--c-accent); font-weight: 600;">{{ __('auth.login_link') }}</a>
        </p>
    </div>
</div>
@endsection
