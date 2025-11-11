<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL; // <-- importa esto
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');

            // opcional: si APP_URL está puesto, fija también el host/base
            if (config('app.url')) {
                URL::forceRootUrl(config('app.url'));
            }
        }
    }
}
