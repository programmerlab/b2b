<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Setting;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Database\Contracts\Setting\SettingContract;
use Ribrit\Mars\Http\Requests\Admin\Setting\SettingUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;

class SettingController extends AdminController
{
    public function __construct(SettingContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(RoleContract $role, ThemeContract $theme, RouteContract $route)
    {
        $this->setRouteMethod();

        return $this->layout([
            'routeDropdown' => $route->dropdown(),
            'adminThemes'   => $theme->groupRows(config('groups.theme.admin.id')),
            'siteThemes'    => $theme->groupRows(config('groups.theme.site.id')),
            'roles'         => $role->rows(),
            'row'           => $this->contract->onlyGroupRow($this->appGroup->id)
        ]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    protected function setRouteMethod()
    {
        $current                  = $this->appRouter->current;
        $current['code']          = 'edit';
        $this->appRouter->current = $current;
        Request::setRouter($this->appRouter);
    }
}