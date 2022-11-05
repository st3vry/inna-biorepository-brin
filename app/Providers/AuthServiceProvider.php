<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('isAdmin', function ($user) {
            return $user->role_code == '0';
        });
        Gate::define('isCurator', function ($user) {
            return $user->role_code == '1';
        });
        Gate::define('isAuthor', function ($user) {
            return $user->role_code == '2';
        });
        // Gate::define('update-post', function ($user, $post) {
        //     return $user->id === $post->user_id;
        // });
    }
}
