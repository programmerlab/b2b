<?php

namespace Ribrit\Mars\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\User\UserAddressContract;
use Ribrit\Mars\Database\Contracts\Zone\ZoneContract;
use Ribrit\Mars\Http\Requests\Admin\User\UserAddress\UserAddressAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserAddress\UserAddressDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserAddress\UserAddressIndexRequest as IndexRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserAddress\UserAddressUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class UserAddressController extends AdminController
{
    public function __construct(UserAddressContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'rows' => $this->contract->requestRows($request)
        ]);
    }

    public function getCreate(IndexRequest $request, ZoneContract $zoneContract)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'countries' => $zoneContract->groupRows(config('groups.zone.country.id'))
        ]);
    }

    public function getEdit($id, IndexRequest $request, ZoneContract $zoneContract)
    {
        $this->setRouterMethod($request);

        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'countries' => $zoneContract->groupRows(config('groups.zone.country.id')),
            'cities'    => $zoneContract->parentRows($row->country_zone_id),
            'towns'     => $zoneContract->parentRows($row->city_zone_id),
            'locations' => $zoneContract->parentRows($row->town_zone_id),
            'row'       => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $row = $this->contract->add($request);

        if ($request->default) {
            $this->contract->defaultAddressUpdate($row);
        }

        $this->createFormData([
            'success' => $this->statusLangMessage('add'),
            'trigger' => [
                '#buttonUserAddressGetIndex'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $row = $this->contract->update($request);

        if ($request->default) {
            $this->contract->defaultAddressUpdate($row);
        }

        $this->createFormData([
            'success' => $this->statusLangMessage('update'),
            'trigger' => [
                '#buttonUserAddressGetIndex'
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