{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <p style="color: var(--c-muted); margin-bottom: 2rem; font-size: 0.9rem;">
            {{ __('review.create_subtitle', ['product' => $viewData['product']->getName()]) }}
        </p>

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('review.store', $viewData['product']->getId()) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">

                    <div style="margin-bottom: 1.25rem;">
                        <label for="rating" class="form-label">{{ __('review.rating') }}</label>
                        <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                            <option value="">{{ __('review.select_rating') }}</option>
                            <option value="1" @selected(old('rating') == 1)>★ {{ __('review.rating_1') }}</option>
                            <option value="2" @selected(old('rating') == 2)>★★ {{ __('review.rating_2') }}</option>
                            <option value="3" @selected(old('rating') == 3)>★★★ {{ __('review.rating_3') }}</option>
                            <option value="4" @selected(old('rating') == 4)>★★★★ {{ __('review.rating_4') }}</option>
                            <option value="5" @selected(old('rating') == 5)>★★★★★ {{ __('review.rating_5') }}</option>
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="comment" class="form-label">
                            {{ __('review.comment') }}
                            <span style="font-size: 0.78rem; color: var(--c-muted); text-transform: none; letter-spacing: 0; font-weight: 400;">
                                ({{ __('review.optional') }})
                            </span>
                        </label>
                        <textarea class="form-control @error('comment') is-invalid @enderror"
                                  id="comment" name="comment" rows="5"
                                  placeholder="{{ __('review.comment_placeholder') }}"
                                  maxlength="1000">{{ old('comment') }}</textarea>
                        <small class="text-muted" style="margin-top: 0.35rem; display: block;">
                            {{ __('review.comment_help', ['min' => 10, 'max' => 1000]) }}
                        </small>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary">{{ __('review.submit') }}</button>
                        <a href="{{ route('product.show', $viewData['product']->getId()) }}" class="btn btn-outline-secondary">
                            {{ __('review.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
