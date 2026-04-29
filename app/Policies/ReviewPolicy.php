<?php

// Author: Emily Cardona Castañeda 

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function delete(User $user, Review $review): bool
    {
        return $user->getId() === $review->getUserId();
    }
}
