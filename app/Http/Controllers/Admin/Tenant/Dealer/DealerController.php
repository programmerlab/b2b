<?php

namespace App\Http\Controllers\Admin\Tenant\Dealer;

use Ribrit\Tenant\Http\Controllers\Admin\Site\SiteController;

class DealerController extends SiteController
{
	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->requestPaginate(request())
		]);
	}
}