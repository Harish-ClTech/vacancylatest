<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuBarProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $statusArray = ['Y','Y','Y','Y','Y','Y','Y','Y'];
        view()->share('statusArray', $statusArray);
    }
}
