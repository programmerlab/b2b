<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Database\Contracts\Order\OrderContract;
use App\Http\Requests\Admin\Dashboard\DashboardIndexRequest as IndexRequest;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;

class DashboardController extends AdminController
{
    public function getIndex(IndexRequest $request)
    {
        return $this->layout([
            'totalDealers'    => app(SiteContract::class)->total(),
            //'totalDailyOrder' => app(OrderContract::class)->dailyTotal(),
        ]);
    }
}
