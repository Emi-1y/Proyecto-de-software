{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.order.update', $viewData['order']->getId()) }}">
                    @csrf
                    @method('PUT')

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label class="form-label">{{ __('order.id') }}</label>
                            <input type="text" class="form-control" value="#{{ $viewData['order']->getId() }}" disabled>
                        </div>
                        <div>
                            <label class="form-label">{{ __('order.total') }}</label>
                            <input type="text" class="form-control" value="{{ $viewData['order']->getFormattedTotal() }}" disabled>
                        </div>
                        <div>
                            <label class="form-label">{{ __('order.user') }}</label>
                            <input type="text" class="form-control" value="{{ $viewData['order']->getUser()->getName() }}" disabled>
                        </div>
                        <div>
                            <label class="form-label">{{ __('order.payment_method') }}</label>
                            <input type="text" class="form-control" value="{{ $viewData['order']->getPaymentMethod() }}" disabled>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.25rem;">
                        <label for="status" class="form-label">{{ __('order.status') }}</label>
                        <select id="status" name="status" class="form-select">
                            @foreach($viewData['statuses'] as $statusKey => $statusLabel)
                                <option value="{{ $statusKey }}"
                                    {{ old('status', $viewData['order']->getStatus()) === $statusKey ? 'selected' : '' }}>
                                    {{ $statusLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($viewData['order']->getItems()->isNotEmpty())
                        <div style="margin-bottom: 1.25rem;">
                            <label class="form-label">{{ __('order.items') }}</label>
                            <div style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
                                @foreach($viewData['order']->getItems() as $item)
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1rem; border-bottom: 1px solid var(--c-border); font-size: 0.88rem;">
                                        <div>
                                            <span style="font-weight: 600;">{{ $item->getDisplayName() }}</span>
                                            <span style="color: var(--c-muted); margin-left: 0.5rem;">× {{ $item->getQuantity() }}</span>
                                            @if($item->getItemType() === 'service')
                                                <span class="badge bg-info" style="margin-left: 0.5rem;">{{ __('order.service_item') }}</span>
                                            @endif
                                        </div>
                                        <span style="font-family: var(--font-mono); color: var(--c-accent-dk);">{{ $item->getFormattedSubTotal() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if($viewData['order']->getStatus() === 'pending' || $viewData['order']->getStatus() === 'paid')
                            <div style="margin-bottom: 1.25rem;">
                                <label for="assigned_worker" class="form-label">{{ __('order.assign_worker') }}</label>
                                <select id="assigned_worker" name="assigned_worker" class="form-select">
                                    <option value="">{{ __('order.no_worker_assigned') }}</option>
                                    @foreach($viewData['workers'] ?? [] as $worker)
                                        <option value="{{ $worker->getId() }}"
                                            {{ old('assigned_worker', $viewData['order']->getAssignedWorkerId()) == $worker->getId() ? 'selected' : '' }}>
                                            {{ $worker->getName() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif

                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary">{{ __('order.update_button') }}</button>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">{{ __('order.back_button') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
