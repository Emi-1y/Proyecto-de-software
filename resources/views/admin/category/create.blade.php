{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div style="margin-bottom: 1rem;">
                        <label for="name" class="form-label">{{ __('category.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label for="description" class="form-label">{{ __('category.description') }}</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary">{{ __('category.save_button') }}</button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">{{ __('category.back_button') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
