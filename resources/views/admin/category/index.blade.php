{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="page-action-bar">
    <div class="page-action-label">{{ __('category.admin_list_subtitle') }}</div>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">+ {{ __('category.create_button') }}</a>
</div>

@if($viewData['categories']->isEmpty())
    <div class="alert alert-info">{{ __('category.empty') }}</div>
@else
    <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>{{ __('category.id') }}</th>
                    <th>{{ __('category.name') }}</th>
                    <th>{{ __('category.description') }}</th>
                    <th>{{ __('category.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['categories'] as $category)
                    <tr>
                        <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--c-muted);">{{ $category->getId() }}</td>
                        <td style="font-weight: 600; font-size: 0.9rem;">{{ $category->getName() }}</td>
                        <td style="font-size: 0.85rem; color: var(--c-muted);">{{ $category->getDescription() }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.category.edit', $category->getId()) }}" class="icon-btn">
                                    {{ __('category.edit_button') }}
                                </a>
                                <form method="POST" action="{{ route('admin.category.destroy', $category->getId()) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger">{{ __('category.delete_button') }}</button>
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
