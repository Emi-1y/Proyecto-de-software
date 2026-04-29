{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="page-action-bar">
    <div class="page-action-label">{{ __('product.admin_list_subtitle') }}</div>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">+ {{ __('product.create_button') }}</a>
</div>

@if($viewData['products']->isEmpty())
    <div class="alert alert-info">{{ __('product.empty') }}</div>
@else
    <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>{{ __('product.id') }}</th>
                    <th>{{ __('product.name') }}</th>
                    <th>{{ __('product.brand') }}</th>
                    <th>{{ __('product.price') }}</th>
                    <th>{{ __('product.category') }}</th>
                    <th>{{ __('product.exclusive') }}</th>
                    <th>{{ __('product.active') }}</th>
                    <th>{{ __('product.stock') }}</th>
                    <th>{{ __('product.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['products'] as $product)
                    <tr>
                        <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--c-muted);">{{ $product->getId() }}</td>
                        <td style="font-weight: 600; font-size: 0.9rem;">{{ $product->getName() }}</td>
                        <td style="font-size: 0.85rem; color: var(--c-muted);">{{ $product->getBrand() }}</td>
                        <td style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--c-accent-dk);">{{ $product->getFormattedPrice() }}</td>
                        <td><span class="badge bg-primary">{{ $product->getCategory()->getName() }}</span></td>
                        <td>
                            @if($product->getExclusive())
                                <span class="badge bg-info">{{ __('layout.yes') }}</span>
                            @else
                                <span style="font-size: 0.8rem; color: var(--c-muted);">{{ __('layout.no') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->getActive())
                                <span class="badge bg-success">{{ __('layout.yes') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('layout.no') }}</span>
                            @endif
                        </td>
                        <td style="font-size: 0.88rem;">{{ $product->getStock() }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.product.edit', $product->getId()) }}" class="icon-btn">
                                    {{ __('product.edit_button') }}
                                </a>
                                <form method="POST" action="{{ route('admin.product.destroy', $product->getId()) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger">{{ __('product.delete_button') }}</button>
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
