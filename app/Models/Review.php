<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * REVIEW ATTRIBUTES
 * $this->attributes['id'] - int - contains the review primary key (id)
 * $this->attributes['user_id'] - int - contains the associated user id
 * $this->attributes['product_id'] - int - contains the associated product id
 * $this->attributes['rating'] - int - contains the review rating
 * $this->attributes['comment'] - string - contains the review comment
 * $this->attributes['created_at'] - timestamp - contains review creation date
 * $this->attributes['updated_at'] - timestamp - contains review update date
 * $this->user - User - contains the associated user
 * $this->product - Product - contains the associated product
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function getComment(): ?string
    {
        return $this->attributes['comment'];
    }

    public function setComment(?string $comment): void
    {
        $this->attributes['comment'] = $comment;
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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
