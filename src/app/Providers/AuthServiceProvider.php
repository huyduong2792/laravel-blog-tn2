<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Media' => 'App\Policies\MediaPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
