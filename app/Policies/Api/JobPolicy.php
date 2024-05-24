<?php

namespace App\Policies\Api;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function modify(User $user , Job $job)
    {
        return $job->employer->user->id === $user->id
        ? Response::allow()
            : Response::deny('You do not own this job.');
    }
}
