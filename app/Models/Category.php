<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * CATEGORY ATTRIBUTES
 * $this->attributes['id'] - int - contains the category primary key (id)
 * $this->attributes['name'] - string - contains the category name
 * $this->attributes['description'] - string - contains the category description
 * $this->attributes['created_at'] - timestamp - contains category creation date
 * $this->attributes['updated_at'] - timestamp - contains category update date
 * $this->products - Product[] - contains the associated products
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

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

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }
}
