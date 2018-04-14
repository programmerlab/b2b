<?php

namespace Ribrit\Mars\Database\Contracts\Currency;

use Ribrit\Mars\Database\Contracts\Contract;

interface CurrencyContract extends Contract
{
	public function add($request);

    public function update($request);

    public function destroy($request);

    public function forget($request);

    public function cacheRows();
}