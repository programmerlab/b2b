<?php

namespace Ribrit\Tenant\Database\Contracts\Status;

use Ribrit\Mars\Database\Contracts\Contract;

interface StatusContract extends Contract
{
	public function add($request);

    public function update($request);

    public function destroy($request);

    public function cacheGroups();

    public function forgetCache($request);
}