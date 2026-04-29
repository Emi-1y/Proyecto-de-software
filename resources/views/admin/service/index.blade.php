{{-- Author:Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="page-action-bar">
    <div class="page-action-label">{{ __('service.admin_list_subtitle') }}</div>
    <a href="{{ route('admin.service.create') }}" class="btn btn-primary">+ {{ __('service.create_button') }}</a>
</div>

@if($viewData['services']->isEmpty())
    <div class="alert alert-info">{{ __('service.empty') }}</div>
@else
    <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>{{ __('service.id') }}</th>
                    <th>{{ __('service.name') }}</th>
                    <th>{{ __('service.employee') }}</th>
                    <th>{{ __('service.price') }}</th>
                    <th>{{ __('service.duration') }}</th>
                    <th>{{ __('service.active') }}</th>
                    <th>{{ __('service.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['services'] as $service)
                    <tr>
                        <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--c-muted);">{{ $service->getId() }}</td>
                        <td style="font-weight: 600; font-size: 0.9rem;">
                            {{ $service->getEmoji() }} {{ $service->getName() }}
                        </td>
                        <td style="font-size: 0.85rem; color: var(--c-muted);">
                            {{ $service->getEmployee() ?? '—' }}
                        </td>
                        <td style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--c-accent-dk);">{{ $service->getFormattedPrice() }}</td>
                        <td style="font-size: 0.85rem;">{{ $service->getDuration() ?? '—' }}</td>
                        <td>
                            @if($service->getActive())
                                <span class="badge bg-success">{{ __('layout.yes') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('layout.no') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.service.edit', $service->getId()) }}" class="icon-btn">
                                    {{ __('service.edit_button') }}
                                </a>
                                <form method="POST" action="{{ route('admin.service.destroy', $service->getId()) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger">{{ __('service.delete_button') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
