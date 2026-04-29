<?php

// Author: Emily Cardona Castañeda 

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * USER ATTRIBUTES
 * $this->attributes['id'] - int - contains the user primary key (id)
 * $this->attributes['name'] - string - contains the user name
 * $this->attributes['email'] - string - contains the user email
 * $this->attributes['email_verified_at'] - timestamp - contains the email verification date
 * $this->attributes['password'] - string - contains the user password
 * $this->attributes['role'] - string - contains the user role
 * $this->attributes['phone'] - string - contains the user phone number
 * $this->attributes['address'] - string - contains the user address
 * $this->attributes['city'] - string - contains the user city
 * $this->attributes['postal_code'] - string - contains the user postal code
 * $this->attributes['remember_token'] - string - contains the remember token
 * $this->attributes['created_at'] - timestamp - contains user creation date
 * $this->attributes['updated_at'] - timestamp - contains user update date
 * $this->orders - Order[] - contains the associated orders
 * $this->reviews - Review[] - contains the associated reviews
 */
class User extends Authenticatable
{
    public const ROLE_ADMIN = 'admin';

    public const ROLE_USER = 'user';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'postal_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function getRole(): string
    {
        return $this->attributes['role'] ?? self::ROLE_USER;
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->attributes['email_verified_at'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getPhone(): ?string
    {
        return $this->attributes['phone'] ?? null;
    }

    public function setPhone(?string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function getAddress(): ?string
    {
        return $this->attributes['address'] ?? null;
    }

    public function setAddress(?string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function getCity(): ?string
    {
        return $this->attributes['city'] ?? null;
    }

    public function setCity(?string $city): void
    {
        $this->attributes['city'] = $city;
    }

    public function getPostalCode(): ?string
    {
        return $this->attributes['postal_code'] ?? null;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->attributes['postal_code'] = $postalCode;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getWishlists(): Collection
    {
        return $this->wishlist;
    }
}
