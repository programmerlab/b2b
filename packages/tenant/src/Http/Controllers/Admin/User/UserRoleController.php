<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Traits\StatusControllerTrait;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;
use Ribrit\Tenant\Database\Contracts\User\UserContract;
use Ribrit\Tenant\Http\Requests\Admin\User\UserRoleAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\User\UserRoleDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\User\UserRoleUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class UserRoleController extends AdminController
{
    use StatusControllerTrait;

    protected $role;

    public function __construct(UserContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
        $this->role = $this->findRole();
    }

    public function getIndex()
    {
        return $this->layout([
            'rows' => $this->contract->codePaginate($this->role->code)
        ]);
    }

    public function getCreate()
    {
        return $this->layout([
            'role'       => $this->role,
            'dealers'    => app(SiteContract::class)->rows(),
            'dataAvatar' => $this->getImageLayout('accessory[avatar]')
        ]);
    }

    public function getEdit($id)
    {
        if (!$row = $this->contract->rowRole($this->role->id, $id)) {
            return error(404);
        }

        return $this->layout([
            'row'        => $row,
            'role'       => $this->role,
            'dealers'    => app(SiteContract::class)->rows(),
            'dataAvatar' => $this->getImageLayout('accessory[avatar]', $row->avatar)
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('main_role', $this->role->id);

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

        $request->offsetSet('main_role', $this->role->id);

        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    protected function findRole()
    {
        if (!$role = app(RoleContract::class)->codeFind(Request::segment(4))) {
            return abort(404);
        }

        return $role;
    }
}