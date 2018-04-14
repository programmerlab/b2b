<?php

/*
 * |--------------------------------------------------------------------------
 * | Admin rotaları
 * |--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'adminApp', 'prefix' => 'admin'], function ($router) {

    foreach (array_merge((array)config('mars.route.adminGroups'), array_get(Cache::get('componentRoutes'), 'group', [])) as $group) {
        $router->get($group['prefix'], 'Admin\Route\RouteController@group')->name($group['name'] . 'GetIndex');
    }

    Route::group(['prefix' => 'account'], function ($router) {
        $router->controller('application', 'Admin\Account\ApplicationController', 'adminAccountApplication');
        $router->controller('logout', 'Admin\Account\LogoutController', 'adminAccountLogout');
        $router->controller('/', 'Admin\Account\AccountController', 'adminAccount');
    });

    Route::group(['prefix' => 'development'], function ($router) {
        Route::group(['middleware' => 'group:setting,4', 'prefix' => 'setting'], function ($router) {
            $router->controller('{group}', 'Admin\Setting\SettingController', route_name_format('setting', 4));
        });

        Route::group(['prefix' => 'view'], function ($router) {

            Route::group(['prefix' => 'menu'], function ($router) {
                $router->controller('link', 'Admin\Menu\MenuLinkController', 'menuLink');
                $router->controller('/', 'Admin\Menu\MenuController', 'menu');
            });

            /*
            Route::group(['middleware' => 'group:theme,5', 'prefix' => 'theme'], function ($router) {
                $router->controller('{group}', 'Admin\Theme\ThemeController', route_name_format('theme', 5));
            });
            */
        });

        Route::group(['prefix' => 'user'], function ($router) {
            $router->controller('role', 'Admin\Role\RoleController', 'role');
            $router->controller('tenant', 'Admin\User\UserTenantController', 'userTenant');
            $router->controller('address', 'Admin\User\UserAddressController', 'userAddress');
            $router->controller('user', 'Admin\User\UserController', 'userAll');
        });

        Route::group(['prefix' => 'group'], function ($router) {
            $router->controller('main', 'Admin\Group\GroupMainController', 'groupMain');
            Route::group(['middleware' => 'group:main,4'], function ($router) {
                $router->controller('{group}', 'Admin\Group\GroupController', route_name_format('group', 4));
            });
        });

        Route::group(['middleware' => 'group:definition,4', 'prefix' => 'definition'], function ($router) {
            $router->controller('{group}', 'Admin\Definition\DefinitionController', route_name_format('definition', 4));
        });

        Route::group(['middleware' => 'group:route,4', 'prefix' => 'route'], function ($router) {
            $router->controller('{group}', 'Admin\Route\RouteController', route_name_format('route', 4));
        });

        Route::group(['prefix' => 'local'], function ($router) {
            $router->controller('lang', 'Admin\Lang\LangController', 'lang');
            $router->controller('currency', 'Admin\Currency\CurrencyController', 'currency');
           
            Route::group(['prefix' => 'zone', 'middleware' => 'group:zone,5'], function ($router) {
                $router->controller('{group}', 'Admin\Zone\ZoneController', route_name_format('zone', 5));
            });
            
        });
    });
});