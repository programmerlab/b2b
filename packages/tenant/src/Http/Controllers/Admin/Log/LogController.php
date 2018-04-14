<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Log;

use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Log\LogContract;
use Ribrit\Tenant\Http\Requests\Admin\Log\LogIndexRequest as LogIndexRequest;

class LogController extends AdminController
{
	public function __construct(LogContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex(LogIndexRequest $request)
	{
		if ($request->layout) {
			$this->layoutCode = $request->layout;
		} else {
			$request->offsetSet('path', null);
		}

		return $this->layout([
			'rows' => $this->contract->requestPaginate($request)
		]);
	}
}