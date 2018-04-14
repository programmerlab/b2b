<?php

namespace Ribrit\Mars\Providers;

use Illuminate\Support\ServiceProvider;
use Ribrit\Mars\Services\ComponentService;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        (new ComponentService())->boot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
