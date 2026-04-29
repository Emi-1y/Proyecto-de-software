<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ORDER ATTRIBUTES
 * $this->attributes['id'] - int - contains the order primary key (id)
 * $this->attributes['total'] - int - contains the order total
 * $this->attributes['payment_method'] - string - contains the payment method
 * $this->attributes['date'] - string - contains the order date
 * $this->attributes['status'] - string - contains the order status
 * $this->attributes['user_id'] - int - contains the related user id
 * $this->attributes['created_at'] - timestamp - contains order creation date
 * $this->attributes['updated_at'] - timestamp - contains order update date
 * $this->user - User - contains the associated user
 * $this->items - Item[] - contains the associated items
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'payment_method',
        'date',
        'status',
        'user_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getPaymentMethod(): string
    {
        return $this->attributes['payment_method'];
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->attributes['payment_method'] = $paymentMethod;
    }

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function placeOrder(): void
    {
        $this->setStatus('pending');
    }

    public function cancelOrder(): void
    {
        $this->setStatus('cancelled');
    }

    public function calculateTotal(): int
    {
        $total = 0;

        foreach ($this->getItems() as $item) {
            $total += $item->calculateSubTotal();
        }

        $this->setTotal($total);

        return $total;
    }

    public function pay(): void
    {
        $this->setStatus('paid');
    }

    public function getFormattedTotal(): string
    {
        return number_format($this->getTotal(), 0, ',', '.').' '.__('product.currency');
    }

    public function getFormattedDate(): string
    {
        return Carbon::parse($this->getDate())->format('d/m/Y');
    }

    public function getFormattedCreatedAt(): string
    {
        return Carbon::parse($this->getCreatedAt())->format('d/m/Y H:i');
    }
}
