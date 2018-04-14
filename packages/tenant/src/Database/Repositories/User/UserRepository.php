<?php

namespace Ribrit\Tenant\Database\Repositories\User;

use Ribrit\Mars\Database\Repositories\User\UserRepository as BaseUserRepository;
use Ribrit\Tenant\Database\Contracts\User\UserContract;

class UserRepository extends BaseUserRepository implements UserContract
{
    public function codePaginate($code)
    {
        return $this->model
            ->currenttenant()
            ->whereHas('roles.role', function ($query) use ($code) {
                $query->whereCode($code);
            })
            ->with($this->with)
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    public function rowRole($roleId, $id)
    {
        return $this->model
            ->currenttenant()
            ->whereHas('roles', function($query) use($roleId) {
                $query->where('role_id', $roleId);
            })
            ->with($this->with)
            ->find($id);
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->tenantAddRelation($row);

        return $row;
    }

    protected function tenantAddRelation($row)
    {
        return $row->tenants()->create([
            'tenant_id' => tenant('id')
        ]);
    }
    
    public function update($request)
    {
        $row = $this->model->currenttenant()->with($this->with)->findOrFail($request->id);

        $row->fill($request->all())->save();

        $row->accessories()->delete();
        $row->roles()->delete();

        $this->addRelationAccessory($row, $request->accessory);
        $this->addRelationMainRole($row, $request->main_role);

        return $row;
    }

    public function activation($request, $user)
    {
        $user->activation()->create([
            'token' => $request->token
        ]);

        return $user;
    }
}