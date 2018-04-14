<?php

return [

	'site' => [
		'images' => [
			'small',
			'medium',
			'large',
			'sidebar'
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Route
	|--------------------------------------------------------------------------
	|
	| Varsayılan rota yapısı
	*/

	'route' => [
		'namespace'   => 'Ribrit\Mars\Http\Controllers',
		'middleware'  => [
			'web',
			'mars'
		],
		'adminGroups' => [
			[
				'prefix' => 'development',
				'name'   => 'development'
			],
			[
				'prefix' => 'development/setting',
				'name'   => 'setting'
			],
			[
				'prefix' => 'development/view',
				'name'   => 'view'
			],
			[
				'prefix' => 'development/user',
				'name'   => 'user'
			],
			[
				'prefix' => 'development/definition',
				'name'   => 'definition'
			],
			[
				'prefix' => 'development/group',
				'name'   => 'group'
			],
			[
				'prefix' => 'development/route',
				'name'   => 'route'
			],
			[
				'prefix' => 'development/local',
				'name'   => 'local'
			],
			[
				'prefix' => 'development/local/zone',
				'name'   => 'zone'
			],

			[
				'prefix' => 'tenant',
				'name'   => 'tenant'
			],
			[
				'prefix' => 'tenant/view',
				'name'   => 'view'
			],
			[
				'prefix' => 'tenant/status',
				'name'   => 'status'
			],
			[
				'prefix' => 'tenant/definition',
				'name'   => 'tenantDefinition'
			],
			[
				'prefix' => 'tenant/draft',
				'name'   => 'draft'
			],

			[
				'prefix' => 'tool',
				'name'   => 'tool'
			],
			[
				'prefix' => 'plugin',
				'name'   => 'plugin'
			],
			[
				'prefix' => 'account',
				'name'   => 'account'
			],

			[
				'prefix' => 'user',
				'name'   => 'tenantUser'
			],
			[
				'prefix' => 'user/department',
				'name'   => 'department'
			],
			[
				'prefix' => 'user/staff',
				'name'   => 'staff'
			],

			[
				'prefix' => 'component',
				'name'   => 'component'
			],
			[
				'prefix' => 'component/application',
				'name'   => 'component.application'
			],
			[
				'prefix' => 'component/api',
				'name'   => 'component.api'
			],
			[
				'prefix' => 'component/payment',
				'name'   => 'component.payment'
			],
			[
				'prefix' => 'component/shipping',
				'name'   => 'component.shipping'
			],
			[
				'prefix' => 'b2b',
				'name'   => 'b2b'
			],
			[
				'prefix' => 'b2b/tenant',
				'name'   => 'b2bTenant'
			],
			[
				'prefix' => 'b2b/tenant/system',
				'name'   => 'b2bTenantSystem'
			],
			[
				'prefix' => 'b2b/tenant/system/tool',
				'name'   => 'b2bTenantSystemTool'
			],
			[
				'prefix' => 'b2b/tenant/system/definition',
				'name'   => 'b2bTenantSystemDefinition'
			],
			[
				'prefix' => 'b2b/tenant/system/status',
				'name'   => 'b2bTenantSystemStatus'
			],
			[
				'prefix' => 'b2b/tenant/shop',
				'name'   => 'b2bTenantShop'
			],
			[
				'prefix' => 'b2b/tenant/cms',
				'name'   => 'b2bTenantCms'
			],
			[
				'prefix' => 'b2b/tenant/payment',
				'name'   => 'b2bTenantPayment'
			],
			[
				'prefix' => 'b2b/tenant/user',
				'name'   => 'b2bTenantUser'
			],
			[
				'prefix' => 'b2b/tenant/report',
				'name'   => 'b2bTenantReport'
			],
		]
	],

	/*
	|--------------------------------------------------------------------------
	| Repository ve Contract
	|--------------------------------------------------------------------------
	|
	| Contract ve repository ilişkileri
	*/

	'repositories' => [

		/*
		 * Uygulamanız
		 */
		'app'  => [
            [
                'namespace' => 'App',
                'path'      => 'Reyon',
                'name'      => 'Reyon',
            ],
            [
                'namespace' => 'App',
                'path'      => 'SellingPrice',
                'name'      => 'SellingPrice',
            ],
            [
                'namespace' => 'App',
                'path'      => 'YearSeasonDefinition',
                'name'      => 'YearSeasonDefinition',
            ],
			[
				'namespace' => 'App',
				'path'      => 'ModelDefinition',
				'name'      => 'ModelDefinition',
			],
            [
                'namespace' => 'App',
                'path'      => 'Renkler',
                'name'      => 'Renkler',
            ],
            [
                'namespace' => 'App',
                'path'      => 'Bedenler',
                'name'      => 'Bedenler',
            ],
            [
                'namespace' => 'App',
                'path'      => 'Brand',
                'name'      => 'Brand',
            ],
			[
				'namespace' => 'App',
				'path'      => 'Category',
				'name'      => 'Category',
			],
			[
				'namespace' => 'App',
				'path'      => 'Product',
				'name'      => 'Product',
			],
			[
				'namespace' => 'App',
				'path'      => 'Basket',
				'name'      => 'Basket',
			],
			[
				'namespace' => 'App',
				'path'      => 'Order',
				'name'      => 'Order',
			],
			[
				'namespace' => 'App',
				'path'      => 'Page',
				'name'      => 'Page',
			],
			[
				'namespace' => 'App',
				'path'      => 'Form',
				'name'      => 'Form',
			],
			[
				'namespace' => 'App',
				'path'      => 'OnlinePayment',
				'name'      => 'OnlinePayment',
			],
			[
				'namespace' => 'App',
				'path'      => 'InstantPayment',
				'name'      => 'InstantPayment',
			],
			[
				'namespace' => 'App',
				'path'      => 'TrafficPayment',
				'name'      => 'TrafficPayment',
			],
			[
				'namespace' => 'App',
				'path'      => 'User',
				'name'      => 'User',
			],
			[
				'namespace' => 'App',
				'path'      => 'TenantRole',
				'name'      => 'TenantRole',
			],
		],

		/*
		 * Zorunlu sınıflar
		 */
		'core' => [
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Definition',
				'name'      => 'Definition',
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Site',
				'name'      => [
					'Site',
					'SiteAccessory',
					'SiteDomain'
				],
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Draft',
				'name'      => 'Draft',
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Component',
				'name'      => [
					'Plugin',
					'Theme',
					'ThemeSite',
				],
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Status',
				'name'      => 'Status',
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Note',
				'name'      => 'Note',
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Log',
				'name'      => 'Log',
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'User',
				'name'      => 'User'
			],
			[
				'namespace' => 'Ribrit\Tenant',
				'path'      => 'Tenant',
				'name'      => [
					'Tenant',
					'TenantDomain',
				],
			],

			/*
			 * Mars
			 */
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Lang',
				'name'      => 'Lang',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Currency',
				'name'      => 'Currency',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Group',
				'name'      => 'Group',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Setting',
				'name'      => 'Setting',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Route',
				'name'      => [
					'RouteMethod',
					'Route',
					'RouteLink'
				]
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Zone',
				'name'      => 'Zone',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Menu',
				'name'      => [
					'Menu',
					'MenuLink'
				],
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Role',
				'name'      => 'Role',
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'User',
				'name'      => [
					'User',
					'UserAddress',
					'UserTenant',
				],
			],
			[
				'namespace' => 'Ribrit\Mars',
				'path'      => 'Definition',
				'name'      => 'Definition',
			],
		]
	]
];