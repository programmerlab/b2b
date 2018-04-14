<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Menu;

use Ribrit\Mars\Database\Contracts\Menu\MenuContract;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class MenuController extends AdminController
{
    public function __construct(MenuContract $contract)
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

    public function getCreate()
    {
        return $this->layout();
    }

    public function getEdit($id)
    {
        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'row' => $row
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
}