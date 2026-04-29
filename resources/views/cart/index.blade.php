{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
@if($viewData['cartItems']->isNotEmpty())
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('order.product') }}</th>
                            <th>{{ __('order.price') }}</th>
                            <th style="min-width: 120px;">{{ __('order.quantity') }}</th>
                            <th>{{ __('order.subtotal') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['cartItems'] as $cartItem)
                        <tr>
                            <td>
                                <div style="font-weight: 600; font-size: 0.9rem; color: var(--c-text);">
                                    {{ $cartItem->getDisplayName() }}
                                </div>
                                @if($cartItem->getItemType() === 'service')
                                    <span style="font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--c-accent); font-weight: 600;">
                                        {{ __('order.service_item') }}
                                    </span>
                                @else
                                    <span style="font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--c-muted);">
                                        {{ $cartItem->getProduct()->getCategory()->getName() }}
                                    </span>
                                @endif
                            </td>
                            <td style="font-family: var(--font-mono); font-size: 0.88rem; color: var(--c-accent-dk);">
                                {{ $cartItem->getFormattedPrice() }}
                            </td>
                            <td>
                                @if($cartItem->getItemType() === 'product')
                                    <input
                                        type="number"
                                        class="form-control quantity-input"
                                        style="max-width: 80px;"
                                        min="1"
                                        max="{{ $cartItem->getProduct()->getStock() }}"
                                        value="{{ $cartItem->getQuantity() }}"
                                        data-product-id="{{ $cartItem->getProductId() }}"
                                        data-csrf="{{ csrf_token() }}"
                                        data-route="{{ route('cart.update', $cartItem->getProductId()) }}"
                                        data-error-message="{{ __('order.cart_update_error') }}">
                                @else
                                    <span style="font-size: 0.9rem; color: var(--c-muted);">1</span>
                                @endif
                            </td>
                            <td class="subtotal-cell" style="font-family: var(--font-mono); font-size: 0.88rem; font-weight: 600; color: var(--c-accent-dk);">
                                {{ $cartItem->getFormattedSubTotal() }}
                            </td>
                            <td>
                                @if($cartItem->getItemType() === 'product')
                                    <form method="POST" action="{{ route('cart.remove', $cartItem->getProductId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            {{ __('order.remove') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                    ← {{ __('order.continue_shopping') }}
                </a>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        {{ __('order.clear_cart') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm" style="position: sticky; top: 84px;">
                <div class="card-header">{{ __('order.order_summary') }}</div>
                <div class="card-body">
                    <div class="cart-total-row" style="border-top: none; padding-top: 0;">
                        <span class="cart-total-label">{{ __('order.total_items') }}</span>
                        <span style="font-size: 0.9rem; font-weight: 600;" id="total-quantity">{{ $viewData['totalQuantity'] }}</span>
                    </div>
                    <div class="cart-total-row">
                        <span class="cart-total-label">{{ __('order.total') }}</span>
                        <span class="cart-total-value" id="total-amount">
                            {{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('product.currency') }}
                        </span>
                    </div>
                    <a href="{{ route('order.checkout') }}" class="btn btn-primary w-100" style="margin-top: 1rem;">
                        {{ __('order.place_order') }} →
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    <div style="text-align: center; padding: 5rem 2rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;"></div>
        <h2 style="font-family: var(--font-display); font-size: 1.75rem; margin-bottom: 0.75rem; color: var(--c-text);">
            {{ __('order.cart_empty_title') }}
        </h2>
        <p style="color: var(--c-muted); margin-bottom: 2rem; max-width: 400px; margin-left: auto; margin-right: auto;">
            {{ __('order.cart_empty') }}
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                {{ __('order.browse_products') }}
            </a>
            <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">
                {{ __('order.browse_services') }}
            </a>
        </div>
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(function (input) {
        input.addEventListener('change', async function () {
            const quantity = this.value;
            if (quantity < 1) return;

            const route = this.dataset.route;
            const csrfToken = this.dataset.csrf;
            const errorMessage = this.dataset.errorMessage;

            try {
                const response = await fetch(route, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ quantity })
                });

                if (!response.ok) throw new Error(errorMessage);

                const data = await response.json();

                if (data.success) {
                    const row = this.closest('tr');
                    const subtotalCell = row.querySelector('.subtotal-cell');
                    subtotalCell.textContent = new Intl.NumberFormat('es-CO', {
                        minimumFractionDigits: 0
                    }).format(data.subtotal) + ' {{ __('product.currency') }}';

                    document.getElementById('total-quantity').textContent = data.totalQuantity;
                    document.getElementById('total-amount').textContent =
                        new Intl.NumberFormat('es-CO', { minimumFractionDigits: 0 }).format(data.totalAmount)
                        + ' {{ __('product.currency') }}';
                }
            } catch (error) {
                alert(errorMessage);
                location.reload();
            }
        });
    });
});
</script>
@endpush
@endsection
