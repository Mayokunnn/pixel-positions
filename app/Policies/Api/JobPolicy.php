<?php

namespace App\Policies\Api;

use App\Models\Employer;
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
        return $job->employer->user_id === $user->id;
    }

    public function create(User $user, Employer $employer){
        return $user->id === $employer->user_id ;
    }
}
