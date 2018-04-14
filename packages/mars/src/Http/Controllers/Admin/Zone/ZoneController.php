<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Zone;

use Illuminate\Support\Facades\Response;
use Ribrit\Mars\Database\Contracts\Zone\ZoneContract;
use Ribrit\Mars\Http\Requests\Admin\Zone\ZoneAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Zone\ZoneDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Zone\ZoneRequest;
use Ribrit\Mars\Http\Requests\Admin\Zone\ZoneSearchRequest as SearchRequest;
use Ribrit\Mars\Http\Requests\Admin\Zone\ZoneUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class ZoneController extends AdminController
{
    public function __construct(ZoneContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(ZoneRequest $request)
    {
        return $this->layout([
            'rows' => $this->contract->groupRequestPaginate($this->appGroup->id, $request)
        ]);
    }

    public function getCreate()
    {
        return $this->layout([
            //
        ]);
    }

    public function getEdit($groupCode, $id)
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
        $this->contract->destroyChild($request);

        return $this->crudMessage($request);
    }

    public function getSearch(SearchRequest $request)
    {
        return $this->{$request->type.'Search'}($request);
    }

    protected function fillSearch($request)
    {
        $results = $this->contract->parentRows($request->parent)->toArray();

        return Response::json($results, 200);
    }
}