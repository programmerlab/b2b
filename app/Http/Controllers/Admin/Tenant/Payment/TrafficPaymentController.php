<?php

namespace App\Http\Controllers\Admin\Tenant\Payment;

use App\Database\Contracts\TrafficPayment\TrafficPaymentContract;
use App\Http\Requests\Admin\Tenant\Payment\TrafficPayment\TrafficPaymentAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Payment\TrafficPayment\TrafficPaymentDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\Payment\TrafficPayment\TrafficPaymentUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class TrafficPaymentController extends AdminController
{
	public function __construct(TrafficPaymentContract $contract)
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