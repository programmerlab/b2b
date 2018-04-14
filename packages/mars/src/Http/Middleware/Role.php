<?php

namespace Ribrit\Mars\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;

class Role
{
    public function handle($request, Closure $next, $guard = null)
    {
	    if ($request->segment(1) == 'api') {
		    return $next($request);
	    }

        $roleContract = app(RoleContract::class);
        $router       = $request->router;
        $roleId       = $request->user() ? $request->user()->role->role_id : setting('user.guest_role');

        if (!$accessRole = $roleContract->getAccessRoute($roleId, array_el_to_el($router->methods, 'id'))) {
            return error(401);
        }

        $request->accessRoute = $this->createAccess($accessRole->accessRoute);

        if (!check_route_access($router->current['code'])) {
            return error(401);
        }

        Config::set('roleAccessRoute', $roleContract->allRoute($accessRole->id));

        return $next($request);
    }

    protected function createAccess($rows)
    {
        $data = [];

        foreach ($rows as $access) {
            $data[ $access->route_link_id ] = $access->status;
        }

        return $data;
    }
}