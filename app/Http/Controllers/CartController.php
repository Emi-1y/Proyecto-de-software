<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\RemoveFromCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Item;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService) {}

    public function index(): View
    {
        $cartItems = $this->cartService->buildCartItems();

        $viewData = [];
        $viewData['title'] = __('order.cart_title');
        $viewData['cartItems'] = $cartItems;
        $viewData['totalQuantity'] = $cartItems->sum(fn (Item $item) => $item->getQuantity());
        $viewData['totalAmount'] = $cartItems->sum(fn (Item $item) => $item->calculateSubTotal());

        return view('cart.index', ['viewData' => $viewData]);
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $productId = (int) $request->validated('product_id', 0);
        $requestedQuantity = (int) $request->validated('quantity', 1);

        $product = Product::where('active', true)->findOrFail($productId);
        $this->cartService->addProduct($product, $requestedQuantity);

        return redirect()->route('cart.index')->with('success', __('order.cart_added_successfully'));
    }

    public function update(UpdateCartItemRequest $request, Product $product): RedirectResponse|JsonResponse
    {
        $activeProduct = Product::where('active', true)->findOrFail($product->getId());
        $quantity = (int) $request->validated('quantity');

        $this->cartService->updateProductQuantity($activeProduct, $quantity);

        if ($request->expectsJson()) {
            $cartItems = $this->cartService->buildCartItems();
            $cartItem = $cartItems->firstWhere(fn (Item $item) => $item->getProductId() === $activeProduct->getId());

            if ($cartItem === null) {
                return response()->json([
                    'success' => false,
                    'message' => __('order.cart_updated_successfully'),
                ], 404);
            }

            return response()->json([
                'success' => true,
                'price' => $cartItem->getPrice(),
                'quantity' => $cartItem->getQuantity(),
                'subtotal' => $cartItem->calculateSubTotal(),
                'totalQuantity' => $cartItems->sum(fn (Item $item) => $item->getQuantity()),
                'totalAmount' => $cartItems->sum(fn (Item $item) => $item->calculateSubTotal()),
            ]);
        }

        return redirect()->route('cart.index')->with('success', __('order.cart_updated_successfully'));
    }

    public function remove(RemoveFromCartRequest $request, Product $product): RedirectResponse
    {
        $this->cartService->removeProduct($product->getId());

        return redirect()->route('cart.index')->with('success', __('order.cart_removed_successfully'));
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', __('order.cart_cleared_successfully'));
    }
}
