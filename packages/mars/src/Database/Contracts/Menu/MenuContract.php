<?php

namespace Ribrit\Mars\Database\Contracts\Menu;

use Ribrit\Mars\Database\Contracts\Contract;

interface MenuContract extends Contract
{
	public function add($request);

    public function update($request);

    public function cacheComponentTreeMenu($current, $menuId);
}