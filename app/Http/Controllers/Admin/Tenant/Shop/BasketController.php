<?php

namespace App\Http\Controllers\Admin\Tenant\Shop;

use App\Database\Contracts\Basket\BasketContract;
use App\Http\Requests\Admin\Tenant\Shop\Basket\BasketAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Shop\Basket\BasketDestroyRequest as DestroyRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class BasketController extends AdminController
{
	public function __construct(BasketContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex()
	{
		if (request('user')) {
			return $this->userIndex();
		}

		return $this->layout([
			'rows' => $this->contract->paginate()
		]);
	}

	protected function userIndex()
	{
		return $this->layout([
			'row' => $this->contract->findUser($this->user->id)
		]);
	}

	public function getShow($id)
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
		$request->offsetSet('site_id', $this->user->site->site_id);

		$this->contract->add($request);

		$this->createFormData([
			'success' => $this->statusLangMessage('add'),
			'trigger' => [
				'#buttonBasketUserGetIndex',
				'#modalUrl .close'
			]
		]);

		return $this->responseFormData(200);
	}

	public function postDestroy(DestroyRequest $request)
	{
		if ($request->user) {
			return $this->userDestroy($request);
		}

		$this->contract->destroy($request);

		return $this->crudMessage($request);
	}

	protected function userDestroy($request)
	{
		$this->contract->destroyProduct($request);

		return $this->crudMessage($request);
	}
}