<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public const HOME = '/beranda';

    public function boot(): void
    {
        //
    }
}
