<?php

namespace App\Providers;

use App\Services\RelationshipService;
use App\Services\UserService;
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
        $this->app->singleton(UserService::class, function() {
            return new UserService();
        });
        $this->app->singleton(RelationshipService::class, function() {
            return new RelationshipService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
