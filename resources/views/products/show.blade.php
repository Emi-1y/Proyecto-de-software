{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="product-detail-wrap">
    <div class="row">
        <div class="col-md-6">
            <div class="product-detail-img">
                <div class="product-detail-img-main">
                    @if($viewData['product']->getImage())
                        <img src="{{ asset('images/products/' . $viewData['product']->getImage()) }}"
                             alt="{{ $viewData['product']->getName() }}">
                    @else
                        <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                            <span style="font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--c-muted); opacity: 0.4;">
                                {{ __('product.no_image') }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="product-detail-info">
                <div class="product-detail-brand">
                    {{ $viewData['product']->getCategory()->getName() }}
                    @if($viewData['product']->getExclusive())
                        &nbsp;·&nbsp; {{ __('product.exclusive') }}
                    @endif
                </div>

                <h1 class="product-detail-name">{{ $viewData['product']->getName() }}</h1>

                <div class="product-detail-price">
                    {{ $viewData['product']->getFormattedPrice() }}
                    @if($viewData['product']->getDiscount() > 0)
                        <span style="font-size: 0.78rem; color: var(--c-earth); margin-left: 0.5rem; font-family: var(--font-body); font-weight: 600;">
                            &minus;{{ $viewData['product']->getDiscount() }}%
                        </span>
                    @endif
                </div>

                @if($viewData['product']->getDescription())
                    <p style="font-size: 0.9rem; color: var(--c-muted); line-height: 1.8; margin-bottom: 1.5rem;">
                        {{ $viewData['product']->getDescription() }}
                    </p>
                @endif

                <div class="product-detail-meta">
                    <div class="product-meta-item">
                        <div class="product-meta-label">{{ __('product.color') }}</div>
                        <div class="product-meta-value">{{ $viewData['product']->getColor() }}</div>
                    </div>
                    <div class="product-meta-item">
                        <div class="product-meta-label">{{ __('product.size') }}</div>
                        <div class="product-meta-value">{{ $viewData['product']->getSize() }}</div>
                    </div>
                    <div class="product-meta-item">
                        <div class="product-meta-label">{{ __('product.stock') }}</div>
                        <div class="product-meta-value">
                            @if($viewData['product']->getStock() > 0)
                                <span style="color: var(--c-success);">{{ $viewData['product']->getStock() }} {{ __('product.available') }}</span>
                            @else
                                <span style="color: var(--c-muted);">{{ __('product.out_of_stock') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-meta-item">
                        <div class="product-meta-label">{{ __('product.category') }}</div>
                        <div class="product-meta-value">{{ $viewData['product']->getCategory()->getName() }}</div>
                    </div>
                </div>

                @if($viewData['product']->getStock() > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
                        <div style="margin-bottom: 0.875rem;">
                            <label class="form-label" for="quantity">{{ __('product.quantity') }}</label>
                            <input id="quantity" type="number" name="quantity" value="1"
                                   min="1" max="{{ $viewData['product']->getStock() }}"
                                   class="form-control" style="max-width: 110px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            {{ __('product.add_to_cart') }}
                        </button>
                    </form>
                @else
                    <button class="btn btn-outline-dark btn-lg w-100" disabled style="opacity: 0.45; cursor: not-allowed;">
                        {{ __('product.out_of_stock') }}
                    </button>
                @endif

                <hr class="product-detail-divider">

                @auth
                    <a href="{{ route('review.create', $viewData['product']->getId()) }}"
                       class="btn btn-outline-dark w-100">
                        {{ __('product.write_review') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">
                        {{ __('product.login_to_review') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>

    @if($viewData['product']->getReviews()->count() > 0)
        <div style="margin-top: 4rem;">
            <div class="section-header">
                <div>
                    <div class="section-title">{{ __('product.reviews') }}</div>
                    <div class="section-subtitle">{{ $viewData['product']->getReviews()->count() }} {{ __('product.review_count') }}</div>
                </div>
            </div>

            <div style="display: grid; gap: 1rem;">
                @foreach($viewData['product']->getReviews() as $review)
                    <div style="background: var(--c-surface); border: 1px solid var(--c-border); border-radius: var(--radius-md); padding: 1.25rem 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                            <div>
                                <div class="review-author">{{ $review->getUser()->getName() }}</div>
                                <div class="review-date">{{ $review->getCreatedAt() }}</div>
                            </div>
                            <div class="review-stars">
                                @for($i = 0; $i < $review->getRating(); $i++) &#9733; @endfor
                                @for($i = $review->getRating(); $i < 5; $i++) <span style="opacity: 0.2;">&#9733;</span> @endfor
                            </div>
                        </div>
                        @if($review->getComment())
                            <p class="review-comment">{{ $review->getComment() }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
