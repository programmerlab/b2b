<?php

namespace Ribrit\Mars\Http\Traits;

use Ribrit\Mars\Http\Requests\Admin\ActiveRequest;
use Ribrit\Mars\Http\Requests\Admin\PassiveRequest;

trait StatusControllerTrait
{
    public function postActive(ActiveRequest $request)
    {
        $this->contract->active($request);

        return $this->crudMessage($request);
    }

    public function postPassive(PassiveRequest $request)
    {
        $this->contract->passive($request);

        return $this->crudMessage($request);
    }
}