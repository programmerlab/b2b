<?php

/*
* |--------------------------------------------------------------------------
* | Admin rotaları
* |--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['adminApp', 'globalTenant'], 'prefix' => 'admin'], function ($router) {
	Route::group(['prefix' => 'development'], function ($router) {
		Route::group(['prefix' => 'view'], function ($router) {
			Route::group(['middleware' => 'group:theme,5', 'prefix' => 'theme'], function ($router) {
				$router->controller('{group}', 'Admin\Theme\ThemeController', route_name_format('theme', 5));
			});
		});
	});

	Route::group(['prefix' => 'tenant'], function ($router) {

		Route::group(['prefix' => 'tenant'], function ($router) {
			$router->controller('domain', 'Admin\Tenant\TenantDomainController', 'tenantDomain');
			$router->controller('accessory', 'Admin\Tenant\TenantAccessoryController', 'tenantBaseAccessory');
			$router->controller('setting', 'Admin\Tenant\TenantSettingController', 'tenantTenantSetting');
			$router->controller('/', 'Admin\Tenant\TenantController', 'tenantBase');
		});

		Route::group(['prefix' => 'site'], function ($router) {
			$router->controller('domain', 'Admin\Site\SiteDomainController', 'siteDomain');
			$router->controller('accessory', 'Admin\Site\SiteAccessoryController', 'siteAccessory');
			$router->controller('/', 'Admin\Site\SiteController', 'site');
		});

		Route::group(['prefix' => 'view'], function ($router) {
			Route::group(['prefix' => 'theme'], function ($router) {
				Route::group(['middleware' => 'group:theme,5'], function ($router) {
					$router->controller('{group}', 'Admin\Theme\ThemeController', route_name_format('theme', 5));
				});
			});
		});

		Route::group(['middleware' => 'group:status,4', 'prefix' => 'status'], function ($router) {
			$router->controller('{group}', 'Admin\Status\StatusController', route_name_format('status', 4));
		});

		Route::group(['middleware' => 'group:definition,4', 'prefix' => 'definition'], function ($router) {
			$router->controller('{group}', 'Admin\Definition\DefinitionController', route_name_format('definition', 4));
		});

		Route::group(['middleware' => 'group:draft,4', 'prefix' => 'draft'], function ($router) {
			$router->controller('{group}', 'Admin\Draft\DraftController', route_name_format('draft', 4));
		});
	});

	Route::group(['prefix' => 'tool'], function ($router) {
		$router->controller('note', 'Admin\Note\NoteController', 'note');
		$router->controller('filemanager', 'Admin\FileManager\FileManagerController', 'filemanager');
		$router->controller('log', 'Admin\Log\LogController', 'log');
	});

	/**
	 * Eklentiler
	 */
	Route::group(['prefix' => 'plugin'], function ($router) {
		Route::group(['middleware' => 'group:plugin,3'], function ($router) {
			$router->controller('{group}', 'Admin\Plugin\PluginController', route_name_format('plugin', 3));
		});
	});

	Route::group(['prefix' => 'user'], function ($router) {
		$router->controller('role/{role}', 'Admin\User\UserRoleController', route_name_format('tenantUserRole', 4));
	});
});