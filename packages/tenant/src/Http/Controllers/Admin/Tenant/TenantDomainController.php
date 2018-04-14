<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Tenant;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantDomainContract;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain\TenantDomainAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain\TenantDomainDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain\TenantDomainRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain\TenantDomainUpdateRequest as UpdateRequest;

class TenantDomainController extends AdminController
{
    public function __construct(TenantDomainContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(TenantDomainRequest $request, TenantContract $tenantContract)
    {
        $this->setRouterMethod($request);


        return $this->layout([
            'rows' => $tenantContract->row($request->tenant)->domains
        ]);
    }

    public function getCreate(TenantDomainRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            //
        ]);
    }

    public function getEdit($id, TenantDomainRequest $request)
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
                '#buttonTenantDomainGetIndex',
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
                '#buttonTenantDomainGetIndex',
                '#modalUrl .close'
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
                'modal' => route_modal_url($this->appRouter->methods['create']['url'] . '?tenant=' . $request->tenant)
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}?tenant=' . $request->tenant)
            ],
        ]);
    }
}