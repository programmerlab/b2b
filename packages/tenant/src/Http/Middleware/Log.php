<?php

namespace Ribrit\Tenant\Http\Middleware;

use Closure;
use Ribrit\Tenant\Database\Contracts\Log\LogContract;

class Log
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
        if ($request->ajax() && $request->method() == 'GET') {
            return $next($request);
        }

        if ($request->is('admin/account/*')) {
            return $next($request);
        }

        $request->offsetSet('path', $request->path());

        if ($request->method() == 'POST') {
            $request->offsetSet('path', str_replace($request->root().'/', '', $request->server('HTTP_REFERER')));
        }

        $log = app(LogContract::class);
        $log->addRoute($request);

        // Next
        return $next($request);
    }
}