<?php

namespace Ribrit\Mars\Database\Contracts\Definition;

use Ribrit\Mars\Database\Contracts\Contract;

interface DefinitionContract extends Contract
{
	public function add($request);

    public function update($request);

    public function destroy($request);

    public function cacheGroups();

    public function forget($request);
}