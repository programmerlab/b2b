<?php

//include base_path('database/app/up.php');
//include base_path('database/app/down.php');

Route::get('/', function () {
});

Route::get('api/{type}/{tenant}/{secret}/get/{method}', 'ApiController@getIndex');
Route::post('api/{type}/{tenant}/{secret}/set/{method}', 'ApiController@postIndex');

Route::group([
    'middleware' => [
        'adminApp',
        'globalTenant'
    ],
    'prefix'     => 'admin'
], function ($router) {

    $router->controller('dashboard', 'Admin\Dashboard\DashboardController', 'dashboard');

    Route::group(['prefix' => 'b2b'], function ($router) {
        Route::group(['prefix' => 'tenant'], function ($router) {
            Route::group(['prefix' => 'system'], function ($router) {

                $router->controller('setting', 'Admin\Tenant\System\SettingController', 'b2bTenantSystemSetting');
                $router->controller('admin', 'Admin\Tenant\System\UserController', 'b2bTenantSystemAdmin');

                Route::group(['prefix' => 'tool'], function ($router) {
                    $router->controller('log', 'Admin\Tenant\System\LogController', 'b2bTenantSystemToolLog');
                    $router->controller('filemanager', 'Admin\Tenant\System\FileManagerController', 'b2bTenantSystemToolFileManager');
                });

                Route::group(['prefix' => 'plugin'], function ($router) {
                    Route::group(['middleware' => 'group:plugin,6'], function ($router) {
                        $router->controller('{group}', 'Admin\Tenant\System\PluginController', route_name_format('b2bTenantSystemPlugin', 6));
                    });
                });

                Route::group([
                    'middleware' => 'group:definition,6',
                    'prefix'     => 'definition'
                ], function ($router) {
                    $router->controller('{group}', 'Admin\Tenant\System\DefinitionController', route_name_format('b2bTenantSystemDefinition', 6));
                });

                Route::group([
                    'middleware' => 'group:status,6',
                    'prefix'     => 'status'
                ], function ($router) {
                    $router->controller('{group}', 'Admin\Tenant\System\StatusController', route_name_format('b2bTenantSystemStatus', 6));
                });

            });

            Route::group(['prefix' => 'dealer'], function ($router) {
                $router->controller('domain', 'Admin\Tenant\Dealer\DealerDomainController', 'b2bTenantDealerDomain');
                $router->controller('setting', 'Admin\Tenant\Dealer\DealerSettingController', 'b2bTenantDealerSetting');
                $router->controller('/', 'Admin\Tenant\Dealer\DealerController', 'b2bTenantDealer');
            });

            Route::group(['prefix' => 'shop'], function ($router) {
                $router->controller('product', 'Admin\Tenant\Shop\ProductController', 'b2bTenantShopProduct');
                $router->controller('basket/user', 'Admin\Tenant\Shop\BasketController', 'b2bTenantShopBasketUser');
                $router->controller('basket', 'Admin\Tenant\Shop\BasketController', 'b2bTenantShopBasket');
                $router->controller('order', 'Admin\Tenant\Shop\OrderController', 'b2bTenantShopOrder');
            });

            Route::group(['prefix' => 'cms'], function ($router) {
                $router->controller('page', 'Admin\Tenant\Cms\PageController', 'b2bTenantCmsPage');
                $router->controller('form', 'Admin\Tenant\Cms\FormController', 'b2bTenantCmsForm');
            });

            Route::group(['prefix' => 'payment'], function ($router) {
                $router->controller('online', 'Admin\Tenant\Payment\OnlinePaymentController', 'b2bTenantPaymentOnline');
                $router->controller('instant', 'Admin\Tenant\Payment\InstantPaymentController', 'b2bTenantPaymentInstant');
                $router->controller('traffic', 'Admin\Tenant\Payment\TrafficPaymentController', 'b2bTenantPaymentTraffic');
            });

            Route::group(['prefix' => 'report'], function ($router) {
                $router->controller('order', 'Admin\Tenant\Report\OrderReportController', 'b2bTenantReportOrder');
                $router->controller('payment', 'Admin\Tenant\Report\PaymentReportController', 'b2bTenantReportPayment');
            });

            Route::group(['prefix' => 'user'], function ($router) {
                $router->controller('user', 'Admin\Tenant\User\UserController', 'b2bTenantUserUser');
                $router->controller('role', 'Admin\Tenant\User\TenantRoleController', 'b2bTenantUserRole');
            });
        });
    });
});