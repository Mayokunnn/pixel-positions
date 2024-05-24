<?php

namespace App\Policies\Api;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function modify(User $currentUser, User $user){
        return $currentUser->id === $user->id;
    }
}
