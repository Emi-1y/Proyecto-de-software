{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.service.store') }}">
                    @csrf
                    @include('admin.service._form', ['service' => null, 'submitText' => __('service.save_button')])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
