{{-- Author: Equipo Raíces --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.user.index') }}" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
            <div>
                <label for="search" class="form-label">{{ __('user.search') }}</label>
                <input type="text" id="search" name="search" class="form-control"
                       placeholder="{{ __('user.search_placeholder') }}" value="{{ $viewData['search'] }}">
            </div>
            <div>
                <label for="role" class="form-label">{{ __('user.filter_role') }}</label>
                <select id="role" name="role" class="form-select">
                    <option value="">{{ __('user.all_roles') }}</option>
                    @foreach($viewData['roles'] as $roleKey => $roleLabel)
                        <option value="{{ $roleKey }}" {{ $viewData['role'] === $roleKey ? 'selected' : '' }}>
                            {{ $roleLabel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ __('user.search') }}</button>
            </div>
        </form>
    </div>
</div>

@if($viewData['users']->isEmpty())
    <div class="alert alert-info">{{ __('user.empty') }}</div>
@else
    <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>{{ __('user.id') }}</th>
                    <th>{{ __('user.name') }}</th>
                    <th>{{ __('user.email') }}</th>
                    <th>{{ __('user.role') }}</th>
                    <th>{{ __('user.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['users'] as $user)
                    <tr>
                        <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--c-muted);">{{ $user->getId() }}</td>
                        <td style="font-weight: 600; font-size: 0.9rem;">{{ $user->getName() }}</td>
                        <td style="font-size: 0.85rem; color: var(--c-muted);">{{ $user->getEmail() }}</td>
                        <td>
                            @if($user->getRole() === 'admin')
                                <span class="badge bg-info">{{ $user->getRole() }}</span>
                            @else
                                <span class="badge bg-primary">{{ $user->getRole() }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.user.edit', $user->getId()) }}" class="icon-btn">
                                {{ __('user.edit_button') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1.25rem;">{{ $viewData['users']->links() }}</div>
@endif
@endsection
