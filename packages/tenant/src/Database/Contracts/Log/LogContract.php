<?php

namespace Ribrit\Tenant\Database\Contracts\Log;

use Ribrit\Mars\Database\Contracts\Contract;

interface LogContract extends Contract
{
	public function requestPaginate($request);

    public function addRoute($request);
}