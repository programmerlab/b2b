<?php

namespace App\Http\Controllers\Admin\Tenant\Shop;

use App\Database\Contracts\Basket\ModelDefinitionContract;
use App\Database\Contracts\Order\OrderContract;
use App\Database\Contracts\TrafficPayment\TrafficPaymentContract;
use App\Http\Requests\Admin\Tenant\Shop\Order\OrderAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\Shop\Order\OrderDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\Shop\Order\OrderUpdateRequest as UpdateRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class OrderController extends AdminController
{
	protected $paymentContract;

	public function __construct(OrderContract $contract, TrafficPaymentContract $paymentContract)
	{
		parent::__construct();

		$this->contract        = $contract;
		$this->paymentContract = $paymentContract;
	}

	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->paginate()
		]);
	}

	public function getCreate()
	{
		return $this->layout([
			'basket' => app(ModelDefinitionContract::class)->findUser($this->user->id)
		]);
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
		$basket = app(ModelDefinitionContract::class)->findUser($this->user->id);

		if (!$basket) {

			$this->createFormData([
				'error' => 'Sepetinizde ürün bulunmuyor!'
			]);

			return $this->responseFormData(400);
		}

		$request->offsetSet('user_id', $this->user->id);
		$request->offsetSet('site_id', $this->user->site->site_id);
		$request->offsetSet('total_price', $basket->total_price);
		$request->offsetSet('quantity', $basket->products());
		$request->offsetSet('products', $basket->products->toArray());

		$order = $this->contract->add($request);
		$basket->delete();

		$this->paymentContract->orderStore($order);

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