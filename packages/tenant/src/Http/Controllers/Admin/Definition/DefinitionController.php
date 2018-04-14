<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Definition;

use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;
use Ribrit\Tenant\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Tenant\Http\Requests\Admin\Definition\DefinitionAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Definition\DefinitionDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Definition\DefinitionUpdateRequest as UpdateRequest;

class DefinitionController extends AdminController
{
    use StatusControllerTrait;
    
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