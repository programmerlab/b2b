<?php

namespace App\Http\Controllers\Admin\Tenant\Payment;

use App\Database\Contracts\OnlinePayment\OnlinePaymentContract;
use App\Http\Requests\Admin\Tenant\Payment\OnlinePayment\OnlinePaymentAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Payment\OnlinePayment\OnlinePaymentDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\Payment\OnlinePayment\OnlinePaymentUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class OnlinePaymentController extends AdminController
{
	public function __construct(OnlinePaymentContract $contract)
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
		$request->offsetSet('user_id', $this->user->id);
		$request->offsetSet('status_id', 37);
		$request->offsetSet('card_name', $request->name);
		$request->offsetSet('card_no', $request->number);

		$row = $this->contract->add($request);

		$this->createFormData([
			'redirect' => [
				'url'     => $this->appRouter->methods['index']['url'],
				'message' => $this->statusLangMessage('add')
			]
		]);

		return $this->responseFormData(200);
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