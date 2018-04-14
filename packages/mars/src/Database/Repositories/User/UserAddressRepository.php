<?php

namespace Ribrit\Mars\Database\Repositories\User;

use Ribrit\Mars\Database\Contracts\User\UserAddressContract;
use Ribrit\Mars\Database\Models\User\UserAddress;
use Ribrit\Mars\Database\Repositories\Repository;

class UserAddressRepository extends Repository implements UserAddressContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with
        = [
            //
        ];

    public function __construct(UserAddress $model)
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
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function defaultAddressUpdate($row)
    {
        $this->model->where('user_id', $row->user_id)->update([
            'default' => 'no'
        ]);

        $this->model->where('id', $row->id)->update([
            'default' => 'yes'
        ]);
    }
}