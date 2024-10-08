<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        $force_https = (bool) env('FORCE_HTTPS', false);
        $except_https = env('EXCEPT_HTTPS');
        $base_url = URL::to('/');
        if ($force_https) {
            if ($base_url != $except_https) {
                config(['session.secure' => true]);
                URL::forceScheme('https');
            }
        }
    }
}
