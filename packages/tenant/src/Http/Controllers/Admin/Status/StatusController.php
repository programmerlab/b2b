<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Status;

use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Status\StatusContract;
use Ribrit\Tenant\Http\Requests\Admin\Status\StatusAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Status\StatusDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Status\StatusUpdateRequest as UpdateRequest;

class StatusController extends AdminController
{
    public function __construct(StatusContract $contract)
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