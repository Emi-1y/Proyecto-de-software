{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
@if($viewData['orders']->isEmpty())
    <div style="text-align: center; padding: 5rem 2rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;"></div>
        <h2 style="font-family: var(--font-display); font-size: 1.75rem; margin-bottom: 0.75rem;">
            {{ __('order.no_orders') }}
        </h2>
        <p style="color: var(--c-muted); margin-bottom: 2rem;">{{ __('order.no_orders_desc') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary">{{ __('order.browse_products') }}</a>
    </div>
@else
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @foreach($viewData['orders'] as $order)
            <div class="order-card">
                <div class="order-card-header">
                    <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                        <div>
                            <div style="font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 2px;">
                                {{ __('order.order_id') }}
                            </div>
                            <div class="order-id">#{{ $order->getId() }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 2px;">
                                {{ __('order.date') }}
                            </div>
                            <div style="font-size: 0.88rem;">{{ $order->getDate() }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted); margin-bottom: 2px;">
                                {{ __('order.total') }}
                            </div>
                            <div style="font-family: var(--font-mono); font-size: 0.9rem; color: var(--c-accent-dk);">
                                {{ $order->getFormattedTotal() }}
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        @if($order->getStatus() === 'pending')
                            <span class="badge bg-warning">{{ __('order.status_pending') }}</span>
                        @elseif($order->getStatus() === 'paid')
                            <span class="badge bg-success">{{ __('order.status_paid') }}</span>
                        @elseif($order->getStatus() === 'shipped')
                            <span class="badge bg-primary">{{ __('order.status_shipped') }}</span>
                        @elseif($order->getStatus() === 'delivered')
                            <span class="badge bg-success">{{ __('order.status_delivered') }}</span>
                        @elseif($order->getStatus() === 'cancelled')
                            <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                        @endif
                        <a href="{{ route('order.show', $order->getId()) }}" class="btn btn-sm btn-outline-dark">
                            {{ __('order.view') }} →
                        </a>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; font-size: 0.85rem; color: var(--c-muted);">
                    {{ __('order.payment_method') }}: <span style="color: var(--c-text); font-weight: 500;">{{ $order->getPaymentMethod() }}</span>
                    &nbsp;·&nbsp; {{ $order->getItems()->count() }} {{ __('order.item_count') }}
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
