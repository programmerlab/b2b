<?php

namespace Ribrit\Mars\Database\Contracts\Route;

use Ribrit\Mars\Database\Contracts\Contract;

interface RouteLinkContract extends Contract
{
	public function inUrl($urls);
}