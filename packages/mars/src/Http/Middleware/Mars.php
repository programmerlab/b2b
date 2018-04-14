<?php

namespace Ribrit\Mars\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Ribrit\Mars\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Mars\Database\Contracts\Group\GroupContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Database\Contracts\Route\RouteMethodContract;
use Ribrit\Mars\Database\Contracts\Setting\SettingContract;
use Ribrit\Mars\Helpers\BreadCrumbsHelper;

class Mars
{
	use Localization;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @param  string|null              $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		if ($request->segment(1) == 'api') {
			return $next($request);
		}

		if ($setting = $this->settingLoad($request)) {
			return $setting;
		}

		if ($local = $this->localizationSet($request)) {
			return $local;
		}

		if ($route = $this->routeLoad($request)) {
			return $route;
		}

		$this->groupSet($request);
		$this->definitionSet($request);

		// Next
		return $next($request);
	}

	protected function settingLoad($request)
	{
		$setting = app(SettingContract::class)->cache();
		$setting['system']['currentPath'] = $this->setCurrentPath($request);
		$mail = Config::get('mail');
		$mail['host'] = $setting['email']['host'];
		$mail['port'] = $setting['email']['port'];
		$mail['from'] = [
			'address' => $setting['email']['from_address'],
			'name'    => $setting['email']['from_name']
		];
		$mail['username'] = $setting['email']['username'];
		$mail['password'] = $setting['email']['password'];

		Config::set('mail', $mail);
		Config::set('setting', $setting);
	}

	protected function setCurrentPath($request)
	{
		if (strstr(join(',', $request->route()->middleware()), 'admin')) {
			return 'admin';
		}

		return 'site';
	}

	protected function routeLoad($request)
	{
		// Load Contract
		$routeContract = app(RouteContract::class);
		$routeMethodContract = app(RouteMethodContract::class);

		$methods = $routeMethodContract->cacheName();
		$method = $this->clearMethod($request->method());

		if (!$name = $request->route()->getName()) {
			if (config('setting.system.type') == 'app') {
				return redirect(route('adminAuthLoginGetIndex'));
			}

			return $this->error($request);
		}

		$segments = $this->createSegments($method, $name);
		$route = $routeContract->cacheFindName($segments[0]);
		$currentMethod = $segments[1] ? $segments[1] : $segments[2];

		if (!$route) {
			return $this->error($request);
		}

		$route->setAttribute('current', $route->methods[ strtolower($currentMethod) ]);
		$request->router = $route;

		Config::set('route.names', $routeContract->cacheGetName());
		Config::set('route.methods', $methods);
		View::share('breadcrumbs', (new BreadCrumbsHelper())->cacheRender($request, $methods));
	}

	protected function createSegments($method, $name)
	{
		$segments = explode($method, $name);

		if (count($segments) != 3) {
			return $segments;
		}

		$segments[0] = $segments[0] . $method;
		$segments[1] = $segments[2];

		return $segments;
	}

	protected function clearMethod($method)
	{
		return ucfirst(strtolower($method));
	}

	protected function error($request)
	{
		if ($request->ajax()) {
			return error(4004, 'errors', 'json');
		} else {
			return error(4004, 'errors');
		}
	}

	protected function groupSet($request)
	{
		Config::set('groups', app(GroupContract::class)->cacheParents());
	}

	protected function definitionSet($request)
	{
		Config::set('definitions', app(DefinitionContract::class)->cacheGroups());
	}
}