{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="stat-grid">
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['productsCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_products') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['servicesCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_services') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['ordersCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_orders') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['usersCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_users') }}</div>
    </div>
</div>

<div class="admin-module-grid" style="margin-bottom: 2.5rem;">
    <div class="admin-module-item">
        <div class="admin-module-icon">🌿</div>
        <div class="admin-module-title">{{ __('admin.products_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.products_description') }}</p>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-sm">{{ __('admin.go_products') }}</a>
    </div>
    <div class="admin-module-item">
        <div class="admin-module-icon">🗂️</div>
        <div class="admin-module-title">{{ __('admin.categories_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.categories_description') }}</p>
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary btn-sm">{{ __('admin.go_categories') }}</a>
    </div>
    <div class="admin-module-item">
        <div class="admin-module-icon">✂️</div>
        <div class="admin-module-title">{{ __('admin.services_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.services_description') }}</p>
        <a href="{{ route('admin.service.index') }}" class="btn btn-primary btn-sm">{{ __('admin.go_services') }}</a>
    </div>
    <div class="admin-module-item">
        <div class="admin-module-icon">📦</div>
        <div class="admin-module-title">{{ __('admin.orders_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.orders_description') }}</p>
        <a href="{{ route('admin.order.index') }}" class="btn btn-primary btn-sm">{{ __('admin.go_orders') }}</a>
    </div>
    <div class="admin-module-item">
        <div class="admin-module-icon">👥</div>
        <div class="admin-module-title">{{ __('admin.users_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.users_description') }}</p>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-sm">{{ __('admin.go_users') }}</a>
    </div>
</div>

@if($viewData['recentOrders']->isNotEmpty())
<div class="page-action-bar">
    <div class="page-action-label">{{ __('admin.recent_orders') }}</div>
    <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('admin.view_all_orders') }}</a>
</div>
<div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>{{ __('order.id') }}</th>
                <th>{{ __('order.user') }}</th>
                <th>{{ __('order.total') }}</th>
                <th>{{ __('order.status') }}</th>
                <th>{{ __('order.date') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($viewData['recentOrders'] as $order)
            <tr>
                <td class="order-id">#{{ $order->getId() }}</td>
                <td style="font-size: 0.88rem;">{{ $order->getUser()?->getName() ?? '—' }}</td>
                <td style="font-family: var(--font-mono); font-size: 0.85rem;">{{ $order->getFormattedTotal() }}</td>
                <td>
                    @if($order->getStatus() === 'pending')
                        <span class="badge bg-warning">{{ __('order.status_pending') }}</span>
                    @elseif($order->getStatus() === 'paid')
                        <span class="badge bg-success">{{ __('order.status_paid') }}</span>
                    @elseif($order->getStatus() === 'delivered')
                        <span class="badge bg-success">{{ __('order.status_delivered') }}</span>
                    @elseif($order->getStatus() === 'cancelled')
                        <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                    @else
                        <span class="badge bg-info">{{ $order->getStatus() }}</span>
                    @endif
                </td>
                <td style="font-size: 0.82rem; color: var(--c-muted);">{{ $order->getDate() }}</td>
                <td>
                    <a href="{{ route('admin.order.edit', $order->getId()) }}" class="btn btn-sm btn-outline-secondary">
                        {{ __('order.edit_button') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
