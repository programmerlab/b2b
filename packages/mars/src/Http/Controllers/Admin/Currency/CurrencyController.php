<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Currency;

use Ribrit\Mars\Database\Contracts\Currency\CurrencyContract;
use Ribrit\Mars\Http\Requests\Admin\Currency\CurrencyAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Currency\CurrencyDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Currency\CurrencyIndexRequest as IndexRequest;
use Ribrit\Mars\Http\Requests\Admin\Currency\CurrencyUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;

class CurrencyController extends AdminController
{
    use StatusControllerTrait;

    public function __construct(CurrencyContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request)
    {
        if ($request->currency) {
            return $this->change($request);
        }

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

    private function change($request)
    {
        $request->session()->set('adminCurrency', $request->currency);
        $request->session()->forget('userAdminCurrency');

        return redirect()->back();
    }
}