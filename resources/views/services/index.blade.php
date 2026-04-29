{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<p style="color: var(--c-muted); max-width: 600px; line-height: 1.8; margin-bottom: 2.5rem;">
    {{ __('service.index_description') }}
</p>

@if($viewData['services']->isEmpty())
    <div class="alert alert-info">{{ __('service.no_services') }}</div>
@else
    <div class="row g-3">
        @foreach($viewData['services'] as $service)
            <div class="col-md-6 col-lg-4">
                <div class="service-card" style="height: 100%; display: flex; flex-direction: column;">
                    <span class="service-card-icon">{{ $service->getEmoji() }}</span>
                    <div class="service-card-title">{{ $service->getName() }}</div>
                    <p style="font-size: 0.88rem; color: var(--c-muted); line-height: 1.7; margin: 0.5rem 0;">
                        {{ $service->getDescription() }}
                    </p>

                    <div style="display: flex; align-items: center; gap: 1rem; margin: 0.75rem 0;">
                        <div class="service-card-price">{{ $service->getFormattedPrice() }}</div>
                        <div class="service-card-meta">⏱ {{ $service->getDuration() }}</div>
                    </div>

                    @if($service->getFeatures())
                        <ul class="service-features">
                            @foreach($service->getFeatures() as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div style="margin-top: auto;">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $service->getId() }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="item_type" value="service">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('service.request_service') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
