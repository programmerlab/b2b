<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Definition;

use Ribrit\Mars\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Requests\Admin\Definition\DefinitionAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Definition\DefinitionDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Definition\DefinitionUpdateRequest as UpdateRequest;

class DefinitionController extends AdminController
{
    public function __construct(DefinitionContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return $this->layout([
            'rows' => $this->contract->groupPaginate($this->appGroup->id)
        ]);
    }

    public function getCreate()
    {
        return $this->layout();
    }

    public function getEdit($group, $id)
    {
        if (!$row = $this->contract->groupRow($id, $this->appGroup->id)) {
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