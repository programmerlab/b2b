<?php

namespace Ribrit\Mars\Database\Contracts\Route;

use Ribrit\Mars\Database\Contracts\Contract;

interface RouteMethodContract extends Contract
{
	public function cacheName();
}