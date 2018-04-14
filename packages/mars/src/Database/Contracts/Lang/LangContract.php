<?php

namespace Ribrit\Mars\Database\Contracts\Lang;

use Ribrit\Mars\Database\Contracts\Contract;

interface LangContract extends Contract
{
	public function add($request);

    public function update($request);

    public function destroy($request);

    public function forget($request);

    public function cacheRows();
}