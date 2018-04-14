<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Group;

use Ribrit\Mars\Database\Contracts\Group\GroupContract;
use Ribrit\Mars\Http\Requests\Admin\Group\GroupAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Group\GroupDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Group\GroupUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class GroupController extends AdminController
{
    public function __construct(GroupContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return $this->layout([
            'rows' => $this->contract->parentPaginate($this->appGroup->id)
        ]);
    }

    public function getCreate()
    {
        return $this->layout();
    }

    public function getEdit($group, $id)
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
        $request->offsetSet('parent_id', $this->appGroup->id);

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