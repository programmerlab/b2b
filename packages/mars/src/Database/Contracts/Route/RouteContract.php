<?php

namespace Ribrit\Mars\Database\Contracts\Route;

use Ribrit\Mars\Database\Contracts\Contract;

interface RouteContract extends Contract
{
	public function roleRows();

    public function getGroupTreeMenu($group, $router);

    public function add($request);

    public function addRelationLinks($row, $request);

    public function addRelationLinkAccess($row);

    public function addRelationLinkTexts($row, $method, $texts);

    public function update($request);

    public function destroyChild($request);

    public function forgetCache($row, $request);

    public function cacheGetName();

    public function cacheFindName($name);
}