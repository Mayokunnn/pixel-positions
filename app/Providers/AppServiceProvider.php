<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use App\Policies\Api\JobPolicy;
use App\Policies\Api\UserPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::unguard();
        Gate::policy(Job::class, JobPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
