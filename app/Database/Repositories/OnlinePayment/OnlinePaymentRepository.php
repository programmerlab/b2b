<?php

namespace App\Database\Repositories\OnlinePayment;

use App\Database\Contracts\OnlinePayment\OnlinePaymentContract;
use App\Database\Models\OnlinePayment\OnlinePayment;
use Ribrit\Mars\Database\Repositories\Repository;

class OnlinePaymentRepository extends Repository implements OnlinePaymentContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(OnlinePayment $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
}