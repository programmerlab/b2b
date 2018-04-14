<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Site;

use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;
use Ribrit\Tenant\Http\Requests\Admin\Site\SiteAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\SiteDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\SiteUpdateRequest as UpdateRequest;

class SiteController extends AdminController
{
    public function __construct(SiteContract $contract)
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