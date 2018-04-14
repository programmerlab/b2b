<?php

namespace Ribrit\Mars\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\User\UserTenantContract;
use Ribrit\Mars\Http\Requests\Admin\User\Tenant\UserTenantAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\User\Tenant\UserTenantDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\User\Tenant\UserTenantIndexRequest as IndexRequest;
use Ribrit\Mars\Http\Requests\Admin\User\Tenant\UserTenantUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;

class UserTenantController extends AdminController
{
    /**
     * Kiracılar
     *
     * @var \Ribrit\Tenant\Database\Contracts\Tenant\TenantContract
     */
    protected $tenantContract;

    public function __construct(UserTenantContract $contract, TenantContract $tenantContract)
    {
        parent::__construct();

        $this->contract       = $contract;
        $this->tenantContract = $tenantContract;
    }

    public function getIndex(IndexRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'rows' => $this->contract->requestRows($request)
        ]);
    }

    public function getCreate(IndexRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'tenants' => $this->tenantContract->whereNotRows(array_el_to_el($this->contract->requestRows($request), 'tenant_id'))
        ]);
    }

    public function getEdit($id, IndexRequest $request)
    {
        $this->setRouterMethod($request);

        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'tenants' => $this->tenantContract->whereNotRows(array_el_to_el($this->contract->requestRows($request), 'tenant_id')),
            'row'     => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $request->offsetSet('tenant_id', $request->app_id);

        $this->contract->add($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('add'),
            'trigger' => [
                '#buttonUserTenantGetIndex'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $request->offsetSet('tenant_id', $request->app_id);

        $this->contract->update($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('update'),
            'trigger' => [
                '#buttonUserTenantGetIndex'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    protected function setRouterMethod($request)
    {
        Request::setRouterMethod([
            'create' => [
                'modal' => route_modal_url($this->appRouter->methods['create']['url'] . '?user=' . $request->user)
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}?user=' . $request->user)
            ],
        ]);
    }
}