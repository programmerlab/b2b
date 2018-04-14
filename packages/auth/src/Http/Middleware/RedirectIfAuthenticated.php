<?php

namespace Ribrit\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return $next($request);
        }

        if (session('tenant_id')) {
            $redirectUrl = Auth::user()->role_redirect;
        } else {
            $redirectUrl = route_name('applicationGetIndex');
        }

        if ($request->ajax()) {
            return Response::json([
                'redirect' => [
                    'url'     => $redirectUrl,
                    'message' => Lang::get('admin::auth/login.success.default')
                ]
            ], 200);
        } else {
            return redirect($redirectUrl);
        }

        return $next($request);
    }
}
