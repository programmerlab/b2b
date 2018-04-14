<?php

namespace Ribrit\Tenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Ribrit\Tenant\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Tenant\Database\Contracts\Status\StatusContract;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Services\ComponentService;

class Tenant
{
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
		if ($request->is(route_name('applicationGetIndex'))) {
			return $next($request);
		}

		$tenant = $this->findTenant($request);

		if ($request->user() && !$tenant) {
			return redirect(route_name('applicationGetIndex'));
		}

		if (!$tenant) {
			return error(1010);
		}

		$request->offsetSet('tenant_id', $tenant->id);

		Config::set('tenant', $tenant->toArray());

		$this->statusSet($request);
		$this->definitionSet($request);
		$this->componentSet($tenant, $request);
		$this->siteSettingSet($tenant, $request);

		// Next
		return $next($request);
	}

	protected function findTenant($request)
	{
		$url = 'http://' . url_clear($request->server('HTTP_HOST'));

		if (!$tenant = app(TenantContract::class)->domainRowCache($url)) {
			return null;
		}

		Session::set('tenant_id', $tenant->id);

		return $tenant;
	}

	protected function statusSet($request)
	{
		Config::set('status', app(StatusContract::class)->cacheGroups());
	}

	protected function definitionSet($request)
	{
		Config::set('tenant_definitions', app(DefinitionContract::class)->cacheGroups());
	}

	protected function componentSet($tenant, $request)
	{
		$service = new ComponentService();
		$service->tenant = $tenant;
		$service->bootTenant();
	}

	protected function siteSettingSet($tenant, $request)
	{
		$this->captchaConfigSet($tenant, $request);
		$this->mailConfigSet($tenant, $request);
		$this->servicesConfigSet($tenant, $request);
	}

	protected function captchaConfigSet($tenant, $request)
	{
		$recaptcha = Config::get('recaptcha');
		$recaptcha['public_key'] = $tenant['site']['captcha_public_key'];
		$recaptcha['private_key'] = $tenant['site']['captcha_private_key'];

		Config::set('recaptcha', $recaptcha);
	}

	protected function mailConfigSet($tenant, $request)
	{
		$mail = Config::get('mail');
		$mail['host'] = $tenant['site']['email_host'];
		$mail['port'] = $tenant['site']['email_port'];
		$mail['from'] = [
			'address' => $tenant['site']['email_from_address'],
			'name'    => $tenant['site']['email_from_name']
		];
		$mail['username'] = $tenant['site']['email_username'];
		$mail['password'] = $tenant['site']['email_password'];

		Config::set('mail', $mail);
	}

	protected function servicesConfigSet($tenant, $request)
	{
		$services = Config::get('services');
		$services['twitter']['client_id'] = $tenant['site']['twitter_id'];
		$services['twitter']['client_secret'] = $tenant['site']['twitter_secret'];
		$services['facebook']['client_id'] = $tenant['site']['facebook_id'];
		$services['facebook']['client_secret'] = $tenant['site']['facebook_secret'];

		Config::set('services', $services);
	}
}