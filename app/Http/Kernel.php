<?php

namespace App\Http;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\Authorize;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Ribrit\Auth\Http\Middleware\Authenticate;
use Ribrit\Auth\Http\Middleware\EncryptCookies;
use Ribrit\Auth\Http\Middleware\RedirectIfAuthenticated;
use Ribrit\Auth\Http\Middleware\VerifyCsrfToken;
use Ribrit\Mars\Http\Middleware\Group;
use Ribrit\Mars\Http\Middleware\Mars;
use Ribrit\Mars\Http\Middleware\Role;
use Ribrit\Tenant\Http\Middleware\ComponentStatus;
use Ribrit\Tenant\Http\Middleware\GlobalTenant;
use Ribrit\Tenant\Http\Middleware\Log;
use Ribrit\Tenant\Http\Middleware\Tenant;
use Ribrit\Tenant\Http\Middleware\View;

class Kernel extends HttpKernel
{
	/**
	 * The application's global HTTP middleware stack.
	 * These middleware are run during every request to your application.
	 *
	 * @var array
	 */
	protected $middleware = [
		CheckForMaintenanceMode::class
	];

	/**
	 * The application's route middleware groups.
	 *
	 * @var array
	 */
	protected $middlewareGroups = [
		'web' => [
			EncryptCookies::class,
			AddQueuedCookiesToResponse::class,
			StartSession::class,
			ShareErrorsFromSession::class,
			VerifyCsrfToken::class
		],

		'mars' => [
			Mars::class,
			Role::class
		],

		'adminAuthApp' => [
			'guest',
			'tenant',
			'view'
		],

		'siteAuthApp' => [
			'tenant',
			'guest',
			'log',
			'view'
		],

		'adminApp' => [
			'auth',
			'tenant',
			'log',
			'view'
		],

		'siteApp' => [
			'tenant',
			'globalTenant',
			'log',
			'view',
		],

		'api' => [
			'throttle:60,1',
		],
	];

	/**
	 * The application's route middleware.
	 * These middleware may be assigned to groups or used individually.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		// Mars
		'guest'            => RedirectIfAuthenticated::class,
		'auth'             => Authenticate::class,
		'group'            => Group::class,

		// Laravel
		'auth.basic'       => AuthenticateWithBasicAuth::class,
		'can'              => Authorize::class,
		'throttle'         => ThrottleRequests::class,

		// Tenant
		'tenant'           => Tenant::class,
		'globalTenant'     => GlobalTenant::class,
		'log'              => Log::class,
		'view'             => View::class,
		'component.status' => ComponentStatus::class,
	];
}