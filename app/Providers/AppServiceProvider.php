<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\ActionLog;
use UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserService::class, UserServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFive();
        view()->composer(
            'dashboard.layouts.notification',
            function ($view) {
                $view->with('notifications',ActionLog::with(['creator'])->where('user_target',auth()->id())->orderBy('created_at', 'desc')->orderBy('seen','asc')->take(10)->get());
            }
        );

        view()->composer(
            'dashboard.layouts.header',
            function ($view) {
                $view->with('unseen',ActionLog::where('user_target',auth()->id())->where('seen',false)->first());
            }
        );
    }
}
