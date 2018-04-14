<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Lang;

use Ribrit\Mars\Database\Contracts\Lang\LangContract;
use Ribrit\Mars\Http\Requests\Admin\Lang\LangAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Lang\LangDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Lang\LangIndexRequest as IndexRequest;
use Ribrit\Mars\Http\Requests\Admin\Lang\LangUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;

class LangController extends AdminController
{
    use StatusControllerTrait;

    public function __construct(LangContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request)
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