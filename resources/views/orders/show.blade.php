{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'] . ' #' . $viewData['order']->getId())

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-3">
            <div class="card-header">{{ __('order.order_details') }}</div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem;">
                    <div>
                        <div style="font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 3px;">{{ __('order.order_id') }}</div>
                        <div class="order-id">#{{ $viewData['order']->getId() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 3px;">{{ __('order.date') }}</div>
                        <div style="font-size: 0.9rem; color: var(--c-text);">{{ $viewData['order']->getDate() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 3px;">{{ __('order.payment_method') }}</div>
                        <div style="font-size: 0.9rem; color: var(--c-text);">{{ $viewData['order']->getPaymentMethod() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 3px;">{{ __('order.status') }}</div>
                        <div>
                            @if($viewData['order']->getStatus() === 'pending')
                                <span class="badge bg-warning">{{ __('order.status_pending') }}</span>
                            @elseif($viewData['order']->getStatus() === 'paid')
                                <span class="badge bg-success">{{ __('order.status_paid') }}</span>
                            @elseif($viewData['order']->getStatus() === 'shipped')
                                <span class="badge bg-primary">{{ __('order.status_shipped') }}</span>
                            @elseif($viewData['order']->getStatus() === 'delivered')
                                <span class="badge bg-success">{{ __('order.status_delivered') }}</span>
                            @elseif($viewData['order']->getStatus() === 'cancelled')
                                <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($viewData['order']->getItems()->isNotEmpty())
        <div class="card shadow-sm">
            <div class="card-header">{{ __('order.items') }}</div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('order.product') }}</th>
                            <th>{{ __('order.quantity') }}</th>
                            <th>{{ __('order.price') }}</th>
                            <th>{{ __('order.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['order']->getItems() as $item)
                        <tr>
                            <td>
                                <div style="font-weight: 600; font-size: 0.9rem;">{{ $item->getDisplayName() }}</div>
                                @if($item->getItemType() === 'service')
                                    <span style="font-size: 0.65rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--c-accent); font-weight: 600;">
                                        {{ __('order.service_item') }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $item->getQuantity() }}</td>
                            <td style="font-family: var(--font-mono); font-size: 0.85rem;">{{ $item->getFormattedPrice() }}</td>
                            <td style="font-family: var(--font-mono); font-size: 0.85rem; font-weight: 600; color: var(--c-accent-dk);">{{ $item->getFormattedSubTotal() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm" style="position: sticky; top: 84px;">
            <div class="card-header">{{ __('order.order_summary') }}</div>
            <div class="card-body">
                <div class="cart-total-row" style="border-top: none; padding-top: 0;">
                    <span class="cart-total-label">{{ __('order.created_at') }}</span>
                    <span style="font-size: 0.82rem; color: var(--c-muted);">{{ $viewData['order']->getCreatedAt() }}</span>
                </div>
                <div class="cart-total-row">
                    <span class="cart-total-label">{{ __('order.total') }}</span>
                    <span class="cart-total-value">{{ $viewData['order']->getFormattedTotal() }}</span>
                </div>
                <a href="{{ route('order.index') }}" class="btn btn-outline-secondary w-100" style="margin-top: 1rem;">
                    ← {{ __('order.back_to_orders') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
