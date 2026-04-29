<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * PRODUCT ATTRIBUTES
 * $this->attributes['id'] - int - contains the product primary key (id)
 * $this->attributes['name'] - string - contains the product name
 * $this->attributes['size'] - string - contains the product size or presentation
 * $this->attributes['brand'] - string - contains the product brand
 * $this->attributes['price'] - int - contains the product price
 * $this->attributes['exclusive'] - bool - indicates whether the product is exclusive
 * $this->attributes['image'] - string - contains the product image filename
 * $this->attributes['description'] - string - contains the product description
 * $this->attributes['color'] - string - contains the product color or variety
 * $this->attributes['discount'] - int - contains the product discount percentage
 * $this->attributes['active'] - bool - indicates whether the product is active
 * $this->attributes['stock'] - int - contains the product stock quantity
 * $this->attributes['category_id'] - int - contains the associated category id
 * $this->attributes['created_at'] - timestamp - contains product creation date
 * $this->attributes['updated_at'] - timestamp - contains product update date
 * $this->category - Category - contains the associated category
 * $this->reviews - Review[] - contains the associated reviews
 * $this->items - Item[] - contains the associated order items
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'brand',
        'price',
        'exclusive',
        'image',
        'description',
        'color',
        'discount',
        'active',
        'stock',
        'category_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getSize(): string
    {
        return $this->attributes['size'];
    }

    public function setSize(string $size): void
    {
        $this->attributes['size'] = $size;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getExclusive(): bool
    {
        return (bool) $this->attributes['exclusive'];
    }

    public function setExclusive(bool $exclusive): void
    {
        $this->attributes['exclusive'] = $exclusive;
    }

    public function getImage(): ?string
    {
        return $this->attributes['image'];
    }

    public function setImage(?string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getColor(): string
    {
        return $this->attributes['color'];
    }

    public function setColor(string $color): void
    {
        $this->attributes['color'] = $color;
    }

    public function getDiscount(): int
    {
        return $this->attributes['discount'];
    }

    public function setDiscount(int $discount): void
    {
        $this->attributes['discount'] = $discount;
    }

    public function getActive(): bool
    {
        return (bool) $this->attributes['active'];
    }

    public function setActive(bool $active): void
    {
        $this->attributes['active'] = $active;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getCategoryId(): int
    {
        return $this->attributes['category_id'];
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->attributes['category_id'] = $categoryId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->getPrice(), 0, ',', '.').' '.__('product.currency');
    }
}
