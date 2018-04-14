<?php

namespace Ribrit\Tenant\Database\Repositories\Site;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;
use Ribrit\Tenant\Database\Models\Site\Site;

class SiteRepository extends Repository implements SiteContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'accessories',
        'domains'
    ];

    public function __construct(Site $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function requestPaginate($request)
    {
        return $this->model->where(function ($query) use ($request) {

            if ($request->dealers) {
                $query->whereIn('id', explode(',', $request->dealers));
            }

            if ($title = $request->q) {
                $query->orWhere('name', 'like', '%' . $title . '%');
                $query->orWhere('code', 'like', '%' . $title . '%');
            }

            if ($request->tax_no) {
                $query->where('tax_no', 'like', '%' . $request->tax_no . '%');
            }

            if ($request->zone) {
                $query->where('tax_zone', 'like', '%' . $request->zone . '%');
            }

            if ($request->point_format) {
                $tag = '=';

                if ($request->point_format == 1) {
                    $tag = '=';
                }

                if ($request->point_format == 2) {
                    $tag = '>=';
                }

                if ($request->point_format == 3) {
                    $tag = '<=';
                }

                $query->where('point', $tag, $request->point);
            }

            if ($request->total_price_format) {
                $tag = '=';

                if ($request->total_price_format == 1) {
                    $tag = '=';
                }

                if ($request->total_price_format == 2) {
                    $tag = '>=';
                }

                if ($request->total_price_format == 3) {
                    $tag = '<=';
                }

                $query->where('total_price', $tag, $request->total_price);
            }

            if ($request->danger_limit_format) {
                $tag = '=';

                if ($request->danger_limit_format == 1) {
                    $tag = '=';
                }

                if ($request->danger_limit_format == 2) {
                    $tag = '>=';
                }

                if ($request->danger_limit_format == 3) {
                    $tag = '<=';
                }

                $query->where('danger_limit', $tag, $request->danger_limit);
            }

        })->paginate($this->perPage);

    }

    public function total()
    {
        return $this->model->count();
    }

    public function add($request)
    {
        $row = parent::add($request);

        $this->forgetCache($request, $row);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);

        $this->forgetCache($request, $row);

        return $row;
    }

    public function updateAccessories($request)
    {
        $row = $this->model->findOrFail($request->id);
        $row->accessories()->delete();

        $this->addRelationAccessory($row, $request->accessory);

        $this->forgetCache($request, $row);

        return $row;
    }

    protected function forgetCache($request, $row)
    {
        Cache::forget('tenant-' . $row->tenant_id);

        foreach ($row['domains'] as $domain)
            Cache::forget(str_slug($domain->url));
        foreach ($row['tenant']['domains'] as $domain)
            Cache::forget(str_slug($domain->url));
    }

    protected function forgetCacheItem($row)
    {
        Cache::forget('tenant-' . $row->tenant_id);

        foreach ($row['domains'] as $domain)
            Cache::forget(str_slug($domain->url));
        foreach ($row['tenant']['domains'] as $domain)
            Cache::forget(str_slug($domain->url));
    }

    public function mikro($items)
    {
        foreach ($items as $data) {
            if ($item = $this->model->where('code', $data->cari_kod)->first()) {
                $item = $this->mikroUpdate($item, $data);
            } else {
                $item = $this->mikroStore($data);
            }

            $this->forgetCacheItem($item);
        }
    }

    protected function mikroStore($data)
    {
        $item = $this->model->create([
            'code'         => $data->cari_kod,
            'name'         => $data->cari_unvan1,
            'tax_zone'     => $data->cari_vdaire_adi,
            'tax_no'       => $data->cari_vdaire_no,
            'zone'         => $data->cari_bolge_kodu,
            'total_price'  => $data->total_price1,
            'danger_limit' => $data->danger_limit,
            'point'        => 0,
        ]);

        $this->accessoryUpdateOrStore($item, $data);

        return $item;
    }

    protected function mikroUpdate($item, $data)
    {
        $item->code = $data->cari_kod;
        $item->name = $data->cari_unvan1;
        $item->tax_zone = $data->cari_vdaire_adi;
        $item->tax_no = $data->cari_vdaire_no;
        $item->zone = $data->cari_bolge_kodu;
        $item->total_price = $data->total_price1;
        $item->danger_limit = $data->danger_limit;
        $item->save();

        $this->accessoryUpdateOrStore($item, $data);

        return $item;
    }

    public function mikroAddress($items)
    {
        foreach ($items as $data) {
            if (!$item = $this->model->where('code', $data->adr_cari_kod)->first()) {
                continue;
            }

            $this->accessoryUpdateOrStore($item, $data);

            $this->forgetCacheItem($item);
        }
    }

    public function mikroHareketler($items)
    {
        foreach ($items as $data) {

            if (!$item = $this->model->where('code', $data->cha_kod)->first()) {
                continue;
            }

            $item->total_price = $data->total_price1;
            $item->save();

            $this->accessoryUpdateOrStore($item, $data);

            $this->forgetCacheItem($item);
        }
    }
}