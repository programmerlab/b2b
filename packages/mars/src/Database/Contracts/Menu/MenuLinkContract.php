<?php

namespace Ribrit\Mars\Database\Contracts\Menu;

use Ribrit\Mars\Database\Contracts\Contract;

interface MenuLinkContract extends Contract
{
	public function getTreeMenu($menuId, $router);

    public function add($request);

    public function update($request);

    public function destroyChild($request);

    public function changeRow($request);

    public function forgetCache($menuId, $request);
}