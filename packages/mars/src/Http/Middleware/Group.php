<?php

namespace Ribrit\Mars\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class Group
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $parent
     * @param  string|null              $child
     * @return mixed
     */
    public function handle($request, Closure $next, $parent = null, $child = null)
    {
        $path = join('.', [
            'groups',
            $parent,
            $request->segment($child)
        ]);

        if (!$request->group = config($path)) {
            return error(4070);
        }

        $request->offsetSet('group_id', $request->group->id);

        View::share('appGroup', $request->group);

        // Next
        return $next($request);
    }
}