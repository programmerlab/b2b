<?php

namespace App\Http\Controllers\Admin\Tenant\Cms;

use App\Database\Contracts\Form\FormContract;
use App\Http\Requests\Admin\Tenant\Cms\Form\FormAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Cms\Form\FormDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\Cms\Form\FormUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class FormController extends AdminController
{
	public function __construct(FormContract $contract)
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