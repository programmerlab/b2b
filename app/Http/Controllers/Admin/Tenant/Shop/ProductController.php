<?php

namespace App\Http\Controllers\Admin\Tenant\Shop;

use App\Database\Contracts\Brand\BrandContract;
use App\Database\Contracts\Category\CategoryContract;
use App\Database\Contracts\Product\ProductContract;
use App\Http\Requests\Admin\Tenant\Shop\Product\ProductIndexRequest;
use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class ProductController extends AdminController
{
    protected $brandContract;

    protected $categoryContract;

    public function __construct(ProductContract $contract, BrandContract $brandContract, CategoryContract $categoryContract)
    {
        parent::__construct();

        $this->contract = $contract;
        $this->brandContract = $brandContract;
        $this->categoryContract = $categoryContract;
    }

    public function getIndex(ProductIndexRequest $request)
    {
        $this->setRouterMethod($request);

        return $this->layout([
            'mainCategories'  => $this->categoryContract->mains(),
            'childCategories' => $this->categoryContract->childs(),
            'brands'          => $this->brandContract->rows(),
            'rows'            => $this->contract->filterPaginate($request)
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

    protected function setRouterMethod($request)
    {
        Request::setRouterMethod([
            'show' => [
                'modal' => route_modal_url($this->appRouter->methods['show']['url'] . '/{id}')
            ],
        ]);
    }
}