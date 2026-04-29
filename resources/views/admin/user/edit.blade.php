{{-- Author: Equipo Raíces --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.user.update', $viewData['user']->getId()) }}">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 1rem;">
                        <label class="form-label">{{ __('user.name') }}</label>
                        <input type="text" class="form-control" value="{{ $viewData['user']->getName() }}" disabled>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label class="form-label">{{ __('user.email') }}</label>
                        <input type="text" class="form-control" value="{{ $viewData['user']->getEmail() }}" disabled>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label for="role" class="form-label">{{ __('user.role') }}</label>
                        <select id="role" name="role" class="form-select">
                            @foreach($viewData['roles'] as $roleKey => $roleLabel)
                                <option value="{{ $roleKey }}"
                                    {{ old('role', $viewData['user']->getRole()) === $roleKey ? 'selected' : '' }}>
                                    {{ $roleLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary">{{ __('user.update_button') }}</button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">{{ __('user.back_button') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
