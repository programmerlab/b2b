<?php

namespace Ribrit\Mars\Database\Repositories\User;

use Ribrit\Mars\Database\Contracts\User\UserTenantContract;
use Ribrit\Mars\Database\Models\User\UserTenant;
use Ribrit\Mars\Database\Repositories\Repository;

class UserTenantRepository extends Repository implements UserTenantContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(UserTenant $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function requestRows($request)
    {
        return $this->model
            ->where('user_id', $request->user)
            ->with($this->with)
            ->get();
    }
}