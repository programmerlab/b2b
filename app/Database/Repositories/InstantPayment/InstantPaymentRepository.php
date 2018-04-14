<?php

namespace App\Database\Repositories\InstantPayment;

use App\Database\Contracts\InstantPayment\InstantPaymentContract;
use App\Database\Models\InstantPayment\InstantPayment;
use Ribrit\Mars\Database\Repositories\Repository;

class InstantPaymentRepository extends Repository implements InstantPaymentContract
{
	public function __construct(InstantPayment $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}
}