<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function create(Product $product): View
    {
        $viewData = [
            'product' => $product,
            'title' => __('review.create_title'),
        ];

        return view('reviews.create', ['viewData' => $viewData]);
    }

    public function store(ReviewRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['product_id'] = $product->getId();

        Review::create($validated);

        return redirect()->route('product.show', $product->getId())
            ->with('success', __('review.created_successfully'));
    }
}
