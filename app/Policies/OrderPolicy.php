<?php

// Author: Emily Cardona Castañeda 

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->getId() === $order->getUserId();
    }

    public function update(User $user, Order $order): bool
    {
        return $user->getId() === $order->getUserId();
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->getId() === $order->getUserId();
    }
}
