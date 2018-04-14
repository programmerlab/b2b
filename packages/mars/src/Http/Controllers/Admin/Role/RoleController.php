<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Role;

use Ribrit\Mars\Database\Contracts\Menu\MenuContract;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Http\Requests\Admin\Role\RoleAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Role\RoleDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Role\RoleUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class RoleController extends AdminController
{
    public function __construct(RoleContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return $this->layout([
            'rows' => $this->contract->paginate()
        ]);
    }

    public function getCreate(MenuContract $menu)
    {
        return $this->layout([
            'menus'           => $menu->rows(),
            'accessFields'    => $this->contract->getAccessFields(),
            'accessRoute'     => $this->groupGetRouteAccess(),
            'roleAccessRoute' => []
        ]);
    }

    public function getEdit($id, MenuContract $menu)
    {
        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'menus'           => $menu->rows(),
            'accessFields'    => $this->contract->getAccessFields(),
            'roleAccess'      => $this->createAccessData($row->access),
            'accessRoute'     => $this->groupGetRouteAccess(),
            'roleAccessRoute' => array_el_to_el($row->accessRoute, 'route_link_id'),
            'row'             => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $row = $this->contract->add($request);

        return $this->crudMessage($request, ['id' => $row->id]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    protected function groupGetRouteAccess()
    {
        $rows = [];

        foreach (app(RouteContract::class)->roleRows() as $row) {
            $rows[ $row->group_id ][] = $row;
        }

        return $rows;
    }

    protected function createAccessData($rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[ $row->position ] = $row->status;
        }

        return $data;
    }
}