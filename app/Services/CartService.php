<?php

// Author: Emily Cardona Castañeda 

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService implements CartServiceInterface
{
    private const CART_KEY = 'shopping_cart';

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function addProduct(Product $product, int $requestedQuantity): void
    {
        $cart = $this->getCart();
        $productId = $product->getId();
        $currentQuantity = (int) ($cart[$productId] ?? 0);
        $quantityToAdd = max(1, $requestedQuantity);
        $newQuantity = min($product->getStock(), $currentQuantity + $quantityToAdd);

        if ($newQuantity > 0) {
            $cart[$productId] = $newQuantity;
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function updateProductQuantity(Product $product, int $quantity): void
    {
        $cart = $this->getCart();
        $productId = $product->getId();

        if (! array_key_exists($productId, $cart)) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = min($product->getStock(), $quantity);
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function removeProduct(int $productId): void
    {
        $cart = $this->getCart();

        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function clear(): void
    {
        Session::forget(self::CART_KEY);
    }

    public function buildCartItems(): Collection
    {
        $cart = $this->getCart();

        if (count($cart) === 0) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->where('active', true)
            ->get()
            ->keyBy(fn (Product $product) => $product->getId());

        return collect($cart)
            ->filter(fn (int $quantity, int $productId) => $quantity > 0 && isset($products[$productId]))
            ->map(function (int $quantity, int $productId) use ($products) {
                $product = $products[$productId];

                $item = new Item;
                $item->setProductId($product->getId());
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setRelation('product', $product);

                return $item;
            })
            ->values();
    }
}
