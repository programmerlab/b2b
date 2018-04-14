<?php

namespace Ribrit\Tenant\Http\Middleware;

use Closure;
use Ribrit\Tenant\Database\Contracts\Component\PluginContract;

class ComponentStatus
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($run = $this->{setting('system.currentPath').'Run'}($request)) {
            return $run;
        }

        return $next($request);
    }

    protected function adminRun($request)
    {
        if (!$group = config('groups.plugin.' . $request->segment(3))) {
            return error(5001);
        }

        if (!$component = app(PluginContract::class)->nameGroupRow($group->id, $request->segment(4))) {
            return error(5002);
        }
    }

    protected function siteRun($request)
    {
        if (!$group = config('groups.plugin.' . $request->segment(2))) {
            return error(5001);
        }

        if (!$component = app(PluginContract::class)->nameGroupRow($group->id, $request->segment(3))) {
            return error(5002);
        }
    }
}