{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm mb-3">
            <div class="card-header">{{ __('checkout.personal_details') }}</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('order.store') }}" method="POST" id="checkoutForm">
                    @csrf

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label for="name" class="form-label">{{ __('checkout.name') }}</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $viewData['user']->getName()) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" class="form-label">{{ __('checkout.phone') }}</label>
                            <input type="tel" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $viewData['user']->getPhone()) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label for="email" class="form-label">{{ __('checkout.email') }}</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $viewData['user']->getEmail()) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label for="address" class="form-label">{{ __('checkout.address') }}</label>
                        <input type="text" name="address" id="address"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $viewData['user']->getAddress()) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                        <div>
                            <label for="city" class="form-label">{{ __('checkout.city') }}</label>
                            <input type="text" name="city" id="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city', $viewData['user']->getCity()) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="postal_code" class="form-label">{{ __('checkout.postal_code') }}</label>
                            <input type="text" name="postal_code" id="postal_code"
                                   class="form-control @error('postal_code') is-invalid @enderror"
                                   value="{{ old('postal_code', $viewData['user']->getPostalCode()) }}" required>
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="payment_method" class="form-label">{{ __('checkout.payment_method') }}</label>
                        <select name="payment_method" id="payment_method"
                                class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="">{{ __('checkout.select_payment_method') }}</option>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>
                                {{ __('order.payment_cash') }}
                            </option>
                            <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>
                                {{ __('order.payment_card') }}
                            </option>
                            <option value="transfer" {{ old('payment_method') === 'transfer' ? 'selected' : '' }}>
                                {{ __('order.payment_transfer') }}
                            </option>
                            <option value="nequi" {{ old('payment_method') === 'nequi' ? 'selected' : '' }}>
                                {{ __('order.payment_nequi') }}
                            </option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                            ← {{ __('checkout.back_to_cart') }}
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('checkout.confirm_order') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm" style="position: sticky; top: 84px;">
            <div class="card-header">{{ __('order.order_summary') }}</div>
            <div class="card-body">
                @foreach($viewData['cartItems'] as $cartItem)
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 0.75rem 0; border-bottom: 1px solid var(--c-border); font-size: 0.88rem;">
                        <div>
                            <div style="font-weight: 600; color: var(--c-text);">{{ $cartItem->getDisplayName() }}</div>
                            <div style="font-size: 0.75rem; color: var(--c-muted);">× {{ $cartItem->getQuantity() }}</div>
                        </div>
                        <div style="font-family: var(--font-mono); color: var(--c-accent-dk); white-space: nowrap; margin-left: 1rem;">
                            {{ $cartItem->getFormattedSubTotal() }}
                        </div>
                    </div>
                @endforeach

                <div class="cart-total-row" style="margin-top: 0.5rem;">
                    <span class="cart-total-label">{{ __('order.total_items') }}</span>
                    <span style="font-weight: 600;">{{ $viewData['totalQuantity'] }}</span>
                </div>
                <div class="cart-total-row">
                    <span class="cart-total-label">{{ __('order.total') }}</span>
                    <span class="cart-total-value">
                        {{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('product.currency') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
