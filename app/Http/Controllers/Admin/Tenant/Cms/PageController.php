<?php

namespace App\Http\Controllers\Admin\Tenant\Cms;

use App\Database\Contracts\Page\PageContract;
use App\Http\Requests\Admin\Tenant\Cms\Page\PageAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Cms\Page\PageDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\Cms\Page\PageUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class PageController extends AdminController
{
	public function __construct(PageContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->paginate()
		]);
	}

	public function getCreate()
	{
		return $this->layout();
	}

	public function getEdit($id)
	{
		if (!$row = $this->contract->row($id)) {
			return error(404);
		}

		return $this->layout([
			'row' => $row
		]);
	}

	public function postAdd(AddRequest $request)
	{
		$row = $this->contract->add($request);

		return $this->crudMessage($request, ['id' => $row->id]);
	}

	public function postUpdate(UpdateRequest $request)
	{
		$this->contract->update($request);

		return $this->crudMessage($request);
	}

	public function postDestroy(DestroyRequest $request)
	{
		$this->contract->destroy($request);

		return $this->crudMessage($request);
	}
}