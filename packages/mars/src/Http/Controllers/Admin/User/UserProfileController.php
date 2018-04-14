<?php

namespace Ribrit\Mars\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\User\UserContract;
use Ribrit\Mars\Http\Requests\Admin\User\UserProfile\UserProfileUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class UserProfileController extends AdminController
{
    public function __construct(UserContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        $this->setRouteMethod();
        $row = $this->contract->row($this->user->id);

        return $this->layout([
            'dataAvatar' => $this->getImageLayout('accessory[avatar]', $row->avatar),
            'row'        => $row
        ]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $request->offsetSet('id', $this->user->id);
        if ($request->password) {
            $request->offsetSet('password', bcrypt($request->password));
        } else {
            $request->offsetUnset('password');
        }

        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    protected function setRouteMethod()
    {
        $current                  = $this->appRouter->current;
        $current['code']          = 'edit';
        $this->appRouter->current = $current;
        Request::setRouter($this->appRouter);
    }
}