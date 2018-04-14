<?php

namespace App\Database\Repositories\TrafficPayment;

use App\Database\Contracts\TrafficPayment\TrafficPaymentContract;
use App\Database\Models\TrafficPayment\TrafficPayment;
use Ribrit\Mars\Database\Repositories\Repository;

class TrafficPaymentRepository extends Repository implements TrafficPaymentContract
{
	public function __construct(TrafficPayment $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function orderStore($order)
	{
		$this->model->create([
			'site_id' => $order->site_id,
			'type_id' => $order->id,
			'type'    => $order->payment_id,
			'alias'   => 'input',
			'price'   => $order->total_price
		]);
	}
}