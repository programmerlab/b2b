<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Route;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\Layout\LayoutContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Http\Requests\Admin\Route\RouteAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Route\RouteDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Route\RouteRowRequest as RowRequest;
use Ribrit\Mars\Http\Requests\Admin\Route\RouteUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class RouteController extends AdminController
{
    public function __construct(RouteContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        $this->setRouterMethod();

        return $this->layout();
    }

    public function getNestable()
    {
        $this->layoutCode = 'index_nestable';
        $this->setRouterMethod();

        return $this->layout([
            'nestable' => $this->contract->getGroupTreeMenu($this->appGroup, $this->appRouter)
        ]);
    }

    public function getCreate()
    {
        $this->setRouterMethod();

        return $this->layout([

        ]);
    }

    public function getEdit($groupCode, $id)
    {
        $this->setRouterMethod();

        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'rowMethods' => $this->getMethods($row),
            'row'        => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $this->contract->add($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('add'),
            'trigger' => [
                '#buttonNestableIndex',
                '#modalUrl .close'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('update'),
            'trigger' => [
                '#buttonNestableIndex',
                '#modalUrl .close'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroyChild($request);

        return $this->crudMessage($request);
    }

    public function postRow(RowRequest $request)
    {
        $this->contract->changeRow($request);

        return $this->crudMessage($request);
    }

    public function group()
    {
        return $this->layout([
            //
        ]);
    }

    protected function getMethods($row)
    {
        $rowMedhods = [];

        foreach ($row->links as $link) {
            $rowMedhods[ $link['method']['code'] ] = $link['method']['code'];
        }

        return join(',', $rowMedhods);
    }

    protected function setRouterMethod()
    {
        Request::setRouterMethod([
            'create' => [
                'modal' => route_modal_url($this->appRouter->methods['create']['url'])
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}')
            ],
        ]);
    }
}
