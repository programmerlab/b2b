<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        // 3. Party uygulamalar
        $this->partyMap($router);

        $router->group(['middleware' => ['web', 'mars']], function ($router) {
            $this->webMap($router);
        });
    }

    /**
     * Sisteme ait tüm rota hariaları
     *
     * @param $router
     * @return void
     */
    protected function webMap($router)
    {
        // Bileşen Rotaları
        //$this->componentMap($router);

        // Auth
        $this->authMap($router);

        // Mars
        $this->marsMap($router);

        // Tenant
        $this->tenantMap($router);

        // App
        $this->appMap($router);
    }

    /**
     * 3. Parti uygulamalara ait rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function partyMap($router)
    {
        $router->group(['prefix' => '_debugbar', 'namespace' => 'Barryvdh\Debugbar\Controllers'], function ($router) {
            $router->get('open', ['uses' => 'OpenHandlerController@handle', 'as' => 'debugbar.openhandler',]);
            $router->get('clockwork/{id}', ['uses' => 'OpenHandlerController@clockwork', 'as' => 'debugbar.clockwork',]);
            $router->get('assets/stylesheets', ['uses' => 'AssetController@css', 'as' => 'debugbar.assets.css',]);
            $router->get('assets/javascript', ['uses' => 'AssetController@js', 'as' => 'debugbar.assets.js',]);
        });
    }

    /**
     * Bileşenlere ait rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function componentMap($router)
    {
        $router->group(['middleware' => ['adminApp', 'globalTenant', 'component.status'], 'prefix' => 'admin/component'], function ($router) {
            foreach (array_get(Cache::get('componentRoutes'), 'admin', []) as $route) {
                $this->componentMapSet($router, $route);
            }
        });

        $router->group(['middleware' => ['siteApp', 'component.status'], 'prefix' => 'component'], function ($router) {
            foreach (array_get(Cache::get('componentRoutes'), 'site', []) as $route) {
                $this->componentMapSet($router, $route);
            }
        });
    }

    /**
     * Türüne göre rotayı işle
     *
     * @param $router
     * @param $route
     * @return void
     */
    protected function componentMapSet($router, $route)
    {
        if (!isset($route['type'])) {
            $router->controller($route['uri'], $route['mixController'], $route['name']);
        } else {
            $router->group(['middleware' => $route['middleware'] . ',' . $route['segment'], 'prefix' => $route['uri']], function ($router) use ($route) {
                $router->controller('{group}', $route['mixController'], route_name_format($route['name'], $route['segment']));
            });
        }
    }

    /**
     * Hesap konbtrolü rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function authMap($router)
    {
        $router->group(['namespace' => 'Ribrit\Auth\Http\Controllers'], function ($router) {
            require base_path('packages/auth/src/Http/routes.php');
        });
    }

    /**
     * Mars uyguluma paketi rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function marsMap($router)
    {
        $router->group(['namespace' => 'Ribrit\Mars\Http\Controllers'], function ($router) {
            require base_path('packages/mars/src/Http/routes.php');
        });
    }

    /**
     * Kiracı paketine ait rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function tenantMap($router)
    {
        $router->group(['namespace' => 'Ribrit\Tenant\Http\Controllers'], function ($router) {
            require base_path('packages/tenant/src/Http/routes.php');
        });
    }

    /**
     * Earth uygulama geliştirme yapısı rota haritaları
     *
     * @param $router
     * @return void
     */
    protected function appMap($router)
    {
        $router->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
