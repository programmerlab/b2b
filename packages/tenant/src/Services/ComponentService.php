<?php

namespace Ribrit\Tenant\Services;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Services\ComponentService as Component;
use Ribrit\Tenant\Database\Models\Tenant\Tenant;

class ComponentService extends Component
{
    /**
     * Kiracı verisi
     *
     * @return void
     */
    public $tenant;

    /**
     * Bütün kiracılara ait bileşen bilgilerini önbelleğe alır
     *
     * @return void
     */
    public function bootAllTenant()
    {
        foreach (Tenant::get() as $tenant) {
            $this->tenant = $tenant;
            $this->bootTenant();
        }
    }

    /**
     * Tenant id değerine göre önbelleğe al
     *
     * @return mixed
     */
    public function bootTenant()
    {
        $components              = $this->bootComponentsTenant();
        $routes                  = $this->bootRoutesTenant($components);
        $providers               = $this->bootProvidersTenant($components);
        $repositoriesToContracts = $this->bootRepositoriesToContractsTenant($components);

        return $components;
    }

    /**
     * Bileşenleri boot ettir
     *
     * @return mixed
     */
    protected function bootComponentsTenant()
    {
        return Cache::rememberForever(cache_name('components'), function () {
            return $this->all();
        });
    }

    /**
     * Bileşen rotalarını önbelleğe al
     *
     * @param $components
     * @return mixed
     */
    protected function bootRoutesTenant($components)
    {
        return Cache::rememberForever(cache_name('componentRoutes'), function () use ($components) {
            return $this->addonsCall($components, 'Routes');
        });
    }

    /**
     * Bileşenlere ait providerları yükle
     *
     * @param $components
     * @return mixed
     */
    protected function bootProvidersTenant($components)
    {
        return Cache::rememberForever(cache_name('componentProviders'), function() use($components) {
            return $this->addonsCall($components, 'Providers');
        });
    }

    /**
     * bootRepositoriesToContracts
     *
     * @param $components
     * @return mixed
     */
    protected function bootRepositoriesToContractsTenant($components)
    {
        return Cache::rememberForever(cache_name('componentRepositoriesToContracts'), function() use($components) {
            return $this->addonsCall($components, 'RepositoriesToContracts');
        });
    }
}