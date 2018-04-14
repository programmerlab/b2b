<?php

namespace Ribrit\Tenant\Providers;

use Illuminate\Support\ServiceProvider;
use Ribrit\Tenant\Services\ComponentService;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $service         = new ComponentService();
        $service->tenant = null;
        $service->bootTenant();
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
