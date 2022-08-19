<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Laravel\Sanctum\Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') == 'production') {
            $this->app['request']->server->set('HTTPS', 'on');
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
