<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ITEM ATTRIBUTES
 * $this->attributes['id'] - int - contains the item primary key (id)
 * $this->attributes['quantity'] - int - contains the item quantity
 * $this->attributes['price'] - int - contains the item unit price at time of purchase
 * $this->attributes['order_id'] - int - contains the related order id
 * $this->attributes['product_id'] - int|null - contains the related product id
 * $this->attributes['service_id'] - int|null - contains the related service id
 * $this->attributes['item_type'] - string - either 'product' or 'service'
 * $this->attributes['created_at'] - timestamp - contains item creation date
 * $this->attributes['updated_at'] - timestamp - contains item update date
 * $this->order - Order - contains the associated order
 * $this->product - Product|null - contains the associated product
 * $this->service - Service|null - contains the associated service
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
        'service_id',
        'item_type',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getProductId(): ?int
    {
        return isset($this->attributes['product_id']) ? (int) $this->attributes['product_id'] : null;
    }

    public function setProductId(?int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getServiceId(): ?int
    {
        return isset($this->attributes['service_id']) ? (int) $this->attributes['service_id'] : null;
    }

    public function setServiceId(?int $serviceId): void
    {
        $this->attributes['service_id'] = $serviceId;
    }

    public function getItemType(): string
    {
        return $this->attributes['item_type'] ?? 'product';
    }

    public function setItemType(string $itemType): void
    {
        $this->attributes['item_type'] = $itemType;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function getDisplayName(): string
    {
        if ($this->getItemType() === 'service' && $this->getService()) {
            return $this->getService()->getName();
        }

        if ($this->getProduct()) {
            return $this->getProduct()->getName();
        }

        return __('order.unknown_item');
    }

    public function calculateSubTotal(): int
    {
        return $this->getQuantity() * $this->getPrice();
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->getPrice(), 0, ',', '.').' '.__('product.currency');
    }

    public function getFormattedSubtotal(): string
    {
        return number_format($this->calculateSubTotal(), 0, ',', '.').' '.__('product.currency');
    }

    public function getFormattedSubTotal(): string
    {
        return $this->getFormattedSubtotal();
    }
}
