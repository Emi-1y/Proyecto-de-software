{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('hero')
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-label fade-up-delay-1">{{ __('home.hero_label') }}</div>
            <h1 class="hero-title fade-up-delay-2">
                {!! __('home.hero_title') !!}
            </h1>
            <p class="hero-desc fade-up-delay-3">
                {{ __('home.hero_description') }}
            </p>
            <div class="hero-cta fade-up-delay-3">
                @auth
                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                        {{ __('home.hero_view_collection') }}
                    </a>
                    <a href="{{ route('service.index') }}" class="btn btn-outline-dark btn-lg">
                        {{ __('home.hero_view_services') }}
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        {{ __('home.hero_start') }}
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark">
                        {{ __('home.hero_login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')

{{-- FEATURED PRODUCTS --}}
<div style="margin-top: 1rem;">
    <div class="section-header">
        <div>
            <div class="section-title">{{ __('home.featured_title') }} <em>{{ __('home.featured_title_em') }}</em></div>
            <div class="section-subtitle">{{ __('home.featured_subtitle') }}</div>
        </div>
        <a href="{{ route('product.index') }}" class="section-link">{{ __('home.view_all') }} →</a>
    </div>

    @if($viewData['featuredProducts']->isEmpty())
        <div class="alert alert-info">{{ __('product.no_products') }}</div>
    @else
        <div class="row g-3">
            @foreach($viewData['featuredProducts'] as $product)
                <div class="col-6 col-md-3">
                    <div class="product-card" style="height: 100%;">
                        <div class="product-img-wrap">
                            @if($product->getImage())
                                <img src="{{ asset('images/products/' . $product->getImage()) }}" alt="{{ $product->getName() }}">
                            @else
                                <div class="product-img-placeholder">
                                    <span>{{ __('product.no_image') }}</span>
                                </div>
                            @endif
                            @if($product->getExclusive())
                                <span class="badge-exclusive">{{ __('product.exclusive') }}</span>
                            @endif
                        </div>
                        <div class="product-body">
                            <div class="product-brand">{{ $product->getCategory()->getName() }}</div>
                            <div class="product-name">{{ $product->getName() }}</div>
                            <div class="product-footer">
                                <span class="product-price">{{ $product->getFormattedPrice() }}</span>
                                @if($product->getStock() > 0)
                                    <span class="stock-badge in-stock">{{ __('product.in_stock') }}</span>
                                @else
                                    <span class="stock-badge out-stock">{{ __('product.out_of_stock') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-dark w-100" style="margin-top: 0.875rem;">
                                {{ __('home.view_detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- SERVICES BANNER --}}
<div style="margin-top: 4rem; background: var(--c-accent-lt); border-radius: var(--radius-lg); padding: 3rem; border: 1px solid var(--c-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
    <div>
        <div style="font-size: 0.72rem; letter-spacing: 0.16em; text-transform: uppercase; color: var(--c-accent); font-weight: 600; margin-bottom: 0.5rem;">
            {{ __('home.services_label') }}
        </div>
        <h2 style="font-family: var(--font-display); font-size: clamp(1.6rem, 4vw, 2.5rem); color: var(--c-accent-dk); font-weight: 600; margin-bottom: 0.5rem;">
            {{ __('home.services_title') }}
        </h2>
        <p style="color: var(--c-muted); max-width: 460px; line-height: 1.75; font-size: 0.9rem;">
            {{ __('home.services_description') }}
        </p>
    </div>
    <a href="{{ route('service.index') }}" class="btn btn-primary btn-lg">
        {{ __('home.services_cta') }}
    </a>
</div>

{{-- CATEGORIES --}}
@if(!$viewData['categories']->isEmpty())
<div style="margin-top: 4rem;">
    <div class="section-header">
        <div>
            <div class="section-title">{{ __('home.categories_title') }}</div>
            <div class="section-subtitle">{{ __('home.categories_subtitle') }}</div>
        </div>
    </div>
    <div class="row g-3">
        @foreach($viewData['categories'] as $category)
            <div class="col-6 col-md-3">
                <a href="{{ route('product.index', ['category' => $category->getId()]) }}"
                   style="display: block; background: var(--c-surface); border: 1px solid var(--c-border); border-radius: var(--radius-md); padding: 1.5rem; text-align: center; text-decoration: none; transition: all 0.24s; box-shadow: var(--shadow-sm);"
                   onmouseover="this.style.borderColor='var(--c-accent)';this.style.transform='translateY(-3px)';"
                   onmouseout="this.style.borderColor='var(--c-border)';this.style.transform='none';">
                    <div style="font-family: var(--font-display); font-size: 1.2rem; font-weight: 600; color: var(--c-text); margin-bottom: 0.3rem;">
                        {{ $category->getName() }}
                    </div>
                    @if($category->getDescription())
                        <div style="font-size: 0.8rem; color: var(--c-muted); line-height: 1.5;">
                            {{ \Illuminate\Support\Str::limit($category->getDescription(), 60) }}
                        </div>
                    @endif
                    <div style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-accent); font-weight: 600; margin-top: 0.75rem;">
                        {{ __('home.explore') }} →
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
