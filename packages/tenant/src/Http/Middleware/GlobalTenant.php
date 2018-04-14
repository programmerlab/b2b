<?php

namespace Ribrit\Tenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Ribrit\Mars\Database\Contracts\Lang\LangContract;

class GlobalTenant
{
    public function handle($request, Closure $next, $guard = null)
    {
        Config::set('tenant_langs', app(LangContract::class)->inRows(tenant('langs')), []);

        return $next($request);
    }
}