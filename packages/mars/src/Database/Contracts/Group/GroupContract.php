<?php

namespace Ribrit\Mars\Database\Contracts\Group;

use Ribrit\Mars\Database\Contracts\Contract;

interface GroupContract extends Contract
{
	public function parentPaginate($parentId);

    public function add($request);

    public function update($request);

    public function destroy($request);

    public function forget($request);

    public function cacheParents();
}