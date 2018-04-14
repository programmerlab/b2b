<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route
    |--------------------------------------------------------------------------
    |
    | Varsayılan rota yapısı
    */

    'route' => [
        'namespace'   => 'Ribrit\Mars\Http\Controllers',
        'middleware'  => ['web', 'mars'],
        'adminGroups' => [
            ['prefix' => 'development', 'name' => 'development'],
            ['prefix' => 'development/setting', 'name' => 'setting'],
            ['prefix' => 'development/view', 'name' => 'view'],
            ['prefix' => 'development/user', 'name' => 'user'],
            ['prefix' => 'development/definition', 'name' => 'definition'],
            ['prefix' => 'development/group', 'name' => 'group'],
            ['prefix' => 'development/route', 'name' => 'route'],
            ['prefix' => 'development/local', 'name' => 'local'],
            ['prefix' => 'development/local/zone', 'name' => 'zone'],

            ['prefix' => 'tenant', 'name' => 'tenant'],
            ['prefix' => 'tenant/view', 'name' => 'view'],
            ['prefix' => 'tenant/status', 'name' => 'status'],
            ['prefix' => 'tenant/definition', 'name' => 'tenantDefinition'],
            ['prefix' => 'tenant/draft', 'name' => 'draft'],

            ['prefix' => 'tool', 'name' => 'tool'],
            ['prefix' => 'tool/seo', 'name' => 'seo'],
            ['prefix' => 'plugin', 'name' => 'plugin'],
            ['prefix' => 'account', 'name' => 'account'],

            ['prefix' => 'user', 'name' => 'tenantUser'],
            ['prefix' => 'user/department', 'name' => 'department'],
            ['prefix' => 'user/staff', 'name' => 'staff']
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

        ],

        /*
         * Zorunlu sınıflar
         */
        'core' => [
            [
                'namespace' => 'Ribrit\Tenant',
                'path'      => 'Menu',
                'name'      => [
                    'TenantMenu',
                    'TenantMenuLink',
                ],
            ],
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
                    'PluginBlock',
                    'Theme',
                    'ThemeSite',
                    'ThemeSiteLayout',
                    'ThemeSiteLayoutContainer',
                    'ThemeSiteLayoutContainerGrid',
                    'ThemeSiteLayoutContainerGridBlock'
                ],
            ],
            [
                'namespace' => 'Ribrit\Tenant',
                'path'      => 'Status',
                'name'      => 'Status',
            ],
            [
                'namespace' => 'Ribrit\Tenant',
                'path'      => 'Seo',
                'name'      => [
                    'SeoRedirect'
                ],
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
                'path'      => 'Image',
                'name'      => 'Image',
            ],
            [
                'namespace' => 'Ribrit\Tenant',
                'path'      => 'User',
                'name'      => 'User'
            ],
            [
                'namespace' => 'Ribrit\Tenant',
                'path'      => 'Tenant',
                'name'      => 'Tenant'
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
                'path'      => 'Layout',
                'name'      => 'Layout',
            ],
            [
                'namespace' => 'Ribrit\Mars',
                'path'      => 'Definition',
                'name'      => 'Definition',
            ],
        ]
    ]
];