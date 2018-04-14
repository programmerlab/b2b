<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Menu;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\Menu\MenuLinkContract;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuLinkAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuLinkDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuLinkRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuLinkRowRequest as RowRequest;
use Ribrit\Mars\Http\Requests\Admin\Menu\MenuLinkUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;

class MenuLinkController extends AdminController
{
    use StatusControllerTrait;

    public function __construct(MenuLinkContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(MenuLinkRequest $request)
    {
        $this->setRouterMethod($request);
        $this->layoutCode           = 'nest';
        $this->contract->nestLayout = $this->createLayoutPath();
        $this->layoutCode           = 'index';

        return $this->layout([
            'nestMenu' => $this->contract->getTreeMenu($request->menu, $this->appRouter)
        ]);
    }

    public function getCreate(MenuLinkRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            //
        ]);
    }

    public function getEdit($id, MenuLinkRequest $request)
    {
        $this->setRouterMethod($request);

        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'row' => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $this->contract->add($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('add'),
            'trigger' => [
                '#buttonMenuLinkGetIndex',
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
                '#buttonMenuLinkGetIndex',
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

    protected function setRouterMethod($request)
    {
        Request::setRouterMethod([
            'create' => [
                'modal' => route_modal_url($this->appRouter->methods['create']['url'] . '?menu=' . $request->menu)
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}?menu=' . $request->menu)
            ],
        ]);
    }
}