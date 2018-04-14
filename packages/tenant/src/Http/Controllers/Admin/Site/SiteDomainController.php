<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Site;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;
use Ribrit\Tenant\Database\Contracts\Site\SiteDomainContract;
use Ribrit\Tenant\Http\Requests\Admin\Site\Domain\SiteDomainAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\Domain\SiteDomainDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\Domain\SiteDomainRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\Domain\SiteDomainUpdateRequest as UpdateRequest;

class SiteDomainController extends AdminController
{
    public function __construct(SiteDomainContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(SiteDomainRequest $request, SiteContract $site)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'rows' => $site->row($request->site)->domains
        ]);
    }

    public function getCreate(SiteDomainRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            //
        ]);
    }

    public function getEdit($id, SiteDomainRequest $request)
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
                '#buttonSiteDomainGetIndex',
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
                '#buttonSiteDomainGetIndex',
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
                'modal' => route_modal_url($this->appRouter->methods['create']['url'] . '?site=' . $request->site)
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}?site=' . $request->site)
            ],
        ]);
    }
}