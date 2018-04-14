<?php

namespace Ribrit\Mars\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Response;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Mars\Database\Contracts\User\UserContract;
use Ribrit\Mars\Http\Requests\Admin\User\UserAddRequest as AddRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserSearchRequest as SearchRequest;
use Ribrit\Mars\Http\Requests\Admin\User\UserUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;

class UserController extends AdminController
{
    use StatusControllerTrait;

    public function __construct(UserContract $contract)
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

    public function getSearch(SearchRequest $request)
    {
        if ($request->type == 'code') {
            $results = $this->contract->searchCodeRows($request);
        } else {
            $results = $this->contract->searchRows($request);
        }

        return Response::json([
            'results' => $results,
            'success' => true
        ], 200);
    }

    public function getCreate(RoleContract $role)
    {
        return $this->layout([
            'roles'      => $role->rows(),
            'dealers'    => app(SiteContract::class)->rows(),
            'dataAvatar' => $this->getImageLayout('accessory[avatar]')
        ]);
    }

    public function getEdit($id, RoleContract $role)
    {
        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'row'        => $row,
            'roles'      => $role->rows(),
            'dealers'    => app(SiteContract::class)->rows(),
            'dataAvatar' => $this->getImageLayout('accessory[avatar]', $row->avatar)
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $request->offsetSet('password', bcrypt($request->password));

        $row = $this->contract->add($request);

        return $this->crudMessage($request, ['id' => $row->id]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        if ($request->password) {
            $request->offsetSet('password', bcrypt($request->password));
        } else {
            $request->offsetUnset('password');
        }

        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }
}