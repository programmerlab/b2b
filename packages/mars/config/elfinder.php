<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */
    'dir'   => [
        'storage/'.tenant('id')
    ],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix'     => 'elfinder',
        'middleware' => 'replace-this-with-your-middleware', //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Ribrit\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => null,

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => [
        'roots' => [
            [
                'uploadAllow'   => [
                    'image/png',
                    'image/jpeg',
                    'application/pdf'
                ],
                'uploadMaxSize' => '15M',
                'uploadDeny'    => [
                    'all'
                ],
                'uploadOrder'   => 'deny,allow',
                'fileMode'      => 0644,
                'dirMode'       => 0755,
            ]
        ],
        'plugin'        => [
            'Sanitizer' => [
                'enable'  => true,
                'targets' => ['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' ', 'ö'], // target chars
                'replace' => '-'    // replace to this
            ]
        ],
        'bind'          => [
            'mkdir.pre mkfile.pre rename.pre archive.pre' => ['Plugin.Sanitizer.cmdPreprocess'],
            'upload.presave'                              => ['Plugin.Sanitizer.onUpLoadPreSave']
        ],
    ]
];
