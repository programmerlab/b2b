<?php

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
| Admin paneli için oluşturulmuş rota parametreleri
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'adminAuthApp', 'prefix' => 'admin/auth'], function ($router) {

    Route::group(['prefix' => 'password'], function ($router) {
        $router->controller('reset', 'Password\PasswordResetController', 'adminAuthPasswordReset');
        $router->controller('/', 'Password\PasswordController', 'adminAuthPassword');
    });

    $router->controller('login', 'Login\LoginController', 'adminAuthLogin');
});

/*
|--------------------------------------------------------------------------
| Site
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'siteAuthApp', 'prefix' => 'auth'], function ($router) {

    Route::group(['prefix' => 'login'], function ($router) {
        $router->controller('twitter', 'Login\LoginTwitterController', 'authLoginTwitter');
        $router->controller('facebook', 'Login\LoginFacebookController', 'authLoginFacebook');
        $router->controller('/', 'Login\LoginController', 'authLogin');
    });

    Route::group(['prefix' => 'password'], function ($router) {
        $router->controller('reset', 'Password\PasswordResetController', 'authPasswordReset');
        $router->controller('/', 'Password\PasswordController', 'authPassword');
    });

    Route::group(['prefix' => 'register'], function ($router) {
        $router->controller('email', 'Register\RegisterEmailController', 'authRegisterEmail');
        $router->controller('/', 'Register\RegisterController', 'authRegister');
    });
});