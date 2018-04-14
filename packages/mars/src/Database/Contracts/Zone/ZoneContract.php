<?php

namespace Ribrit\Mars\Database\Contracts\Zone;

use Ribrit\Mars\Database\Contracts\Contract;

interface ZoneContract extends Contract
{
	public function add($request);

    public function update($request);
}