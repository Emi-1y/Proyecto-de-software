<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Order::with('user')->orderByDesc('id');

        if (! empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('id', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    });
            });
        }

        if (! empty($status)) {
            $query->where('status', $status);
        }

        $viewData = [];
        $viewData['title'] = __('order.admin_list_title');
        $viewData['subtitle'] = __('order.admin_list_subtitle');
        $viewData['orders'] = $query->paginate(30)->appends($request->query());
        $viewData['search'] = $search;
        $viewData['status'] = $status;
        $viewData['statuses'] = [
            'pending' => __('order.status_pending'),
            'paid' => __('order.status_paid'),
            'shipped' => __('order.status_shipped'),
            'delivered' => __('order.status_delivered'),
            'cancelled' => __('order.status_cancelled'),
        ];

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function edit(Order $order): View
    {
        $viewData = [];
        $viewData['title'] = __('order.edit_title');
        $viewData['subtitle'] = __('order.edit_subtitle');
        $viewData['order'] = $order->load('user', 'items.product');
        $viewData['statuses'] = [
            'pending' => __('order.status_pending'),
            'paid' => __('order.status_paid'),
            'shipped' => __('order.status_shipped'),
            'delivered' => __('order.status_delivered'),
            'cancelled' => __('order.status_cancelled'),
        ];

        return view('admin.order.edit')->with('viewData', $viewData);
    }

    public function update(UpdateOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return redirect()
            ->route('admin.order.index')
            ->with('success', __('order.updated_successfully'));
    }
}
