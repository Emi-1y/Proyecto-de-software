<?php

// Author: Emily Cardona Castañeda 

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use App\Services\CartService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService();
        });
    }

    public function boot(): void
    {
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Review::class, ReviewPolicy::class);
    }
}
