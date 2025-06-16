<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;

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
       Paginator::useBootstrapFive();

       // Ensure HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            
            // Additional security headers
            $this->app['request']->server->set('HTTPS', 'on');
        }

        // Set default string length for MySQL
        Schema::defaultStringLength(191);
    }
    
}
