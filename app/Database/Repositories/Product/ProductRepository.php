<?php

namespace App\Database\Repositories\Product;

use App\Database\Contracts\Product\ProductContract;
use App\Database\Models\Product\Product;
use Ribrit\Mars\Database\Repositories\Repository;

class ProductRepository extends Repository implements ProductContract
{
    public function __construct(Product $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function filterPaginate($request)
    {
        return $this->model->where(function ($query) use ($request) {

            if ($request->code) {
                $query->where('sto_kod', 'like', '%' . $request->code . '%');
            }

            if ($request->title) {
                $query->where('sto_isim', 'like', '%' . $request->title . '%');
            }

            if ($request->unit_format) {
                $tag = '=';

                if ($request->unit_format == 1) {
                    $tag = '=';
                }

                if ($request->unit_format == 2) {
                    $tag = '>=';
                }

                if ($request->unit_format == 3) {
                    $tag = '<=';
                }

                $query->where('unit', $tag, $request->unit);
            }

            if ($request->main_categories) {
                $query->whereIn('sto_anagrup_kod', explode(',', $request->main_categories));
            }

            if ($request->child_categories) {
                $query->whereIn('sto_altgrup_kod', explode(',', $request->child_categories));
            }

            if ($request->brands) {
                $query->whereIn('sto_marka_kodu', explode(',', $request->brands));
            }

            if ($request->min_price) {
                $query->whereHas('price', function ($query) use ($request) {
                    $query->where('sfiyat_fiyati', '>=', $request->min_price);
                });
            }

            if ($request->max_price) {
                $query->whereHas('price', function ($query) use ($request) {
                    $query->where('sfiyat_fiyati', '<=', $request->max_price);
                });
            }

        })->orderBy('created_at', 'desc')->with($this->with)->paginate($this->perPage);
    }

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->sto_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item = $this->mikroUpdate($item, $data);
            } else {
                $item = $this->mikroStore($data);
            }

            $this->mikroOptions($item, $data->renk_beden);

            unset($data->renk_beden);

            $this->accessoryUpdateOrStore($item, (array)$data);

        }
    }

    protected function mikroOptions($item, $options)
    {
        foreach ($options as $no => $option) {
            if ($product = $item->options()->where('no', $no)->first()) {
                $product->fill((array)$option)->save();
            } else {
                $option->no = $no;
                $item->options()->create((array)$option);
            }
        }
    }

    protected function mikroStore($data)
    {
        return $this->model->create((array)$data);
    }

    protected function mikroUpdate($item, $data)
    {
        $item->fill((array)$data)->save();

        return $item;
    }

    public function mikroMovements($items)
    {
        foreach ($items as $data) {
            if (!$product = $this->model->where('sto_kod', $data->sth_stok_kod)->first()) {
                continue;
            }

            $data->match_id = $data->sth_RECno;

            if ($item = $product->movements()->where('match_id', $data->sth_RECno)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $product->movements()->create((array)$data);
            }
        }
    }

    public function mikroPrices($items)
    {
        foreach ($items as $data) {
            if (!$product = $this->model->where('sto_kod', $data->sfiyat_stokkod)->first()) {
                continue;
            }

            $data->match_id = $data->sfiyat_RECno;

            if ($item = $product->prices()->where('match_id', $data->sfiyat_RECno)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $product->prices()->create((array)$data);
            }
        }
    }

    public function mikroDiscounts($items)
    {
        foreach ($items as $data) {
            if (!$product = $this->model->where('sto_kod', $data->isk_stok_kod)->first()) {
                continue;
            }

            $data->match_id = $data->isk_RECno;

            if ($item = $product->discounts()->where('match_id', $data->isk_RECno)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $product->discounts()->create((array)$data);
            }
        }
    }
}