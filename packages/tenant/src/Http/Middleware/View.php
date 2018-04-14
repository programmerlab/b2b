<?php

namespace Ribrit\Tenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View as BaseView;
use Ribrit\Mars\Database\Contracts\Menu\MenuContract;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;

class View
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
        if ($result = $this->{setting('system.currentPath') . 'ThemeRun'}($request)) {
            return $result;
        }

        // Next
        return $next($request);
    }

    protected function siteThemeRun($request)
    {
        if (setting('system.type') != 'site') {
            return redirect(route_name('adminAuthLoginGetIndex'));
        }

        if (!$theme = app(ThemeContract::class)->cacheSiteTheme(tenant_site())) {
            return error(1000);
        }

        $this->themeSet($theme);
    }

    protected function adminThemeRun($request)
    {
        if (!$theme = app(ThemeContract::class)->cacheTheme(tenant('theme'))) {
            return error(1000);
        }

        $this->themeSet($theme);
        $this->menuAdminSet($request);
    }

    protected function authThemeRun($request)
    {
        Config::set('tenant', app(TenantContract::class)->row(1)->toArray());

        if (!$theme = app(ThemeContract::class)->cacheTheme(setting('theme.admin'))) {
            return error(1000);
        }

        $theme['group_code'] = 'auth';
        $this->themeSet($theme);

        $theme['group_code'] = 'admin';
        $this->themeSet($theme);
    }

    protected function themeSet($theme)
    {
        $path = base_path($theme['directory']);

        Lang::addNameSpace($theme['group_code'], $path . 'lang');
        BaseView::addNameSpace($theme['group_code'], $path . 'views');
        Config::set('theme', $theme);
    }

    protected function menuAdminSet($request)
    {
        $main = null;
        $add  = null;

        if ($request->user()) {
            $menuContract = app(MenuContract::class);
            $code         = $request->getRouter()->group->code;

            $main = $menuContract->cacheComponentTreeMenu($code, $request->user()->role->role->main_menu_id);
            //$add  = $menuContract->cacheComponentTreeMenu($code, $request->user()->role->role->add_menu_id);
        }

        BaseView::share('menu', [
            'main' => $main,
            'add'  => $add,
        ]);
    }
}