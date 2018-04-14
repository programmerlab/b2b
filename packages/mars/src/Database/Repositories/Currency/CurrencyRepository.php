<?php

namespace Ribrit\Mars\Database\Repositories\Currency;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Currency\CurrencyContract;
use Ribrit\Mars\Database\Models\Currency\Currency;
use Ribrit\Mars\Database\Repositories\Repository;

class CurrencyRepository extends Repository implements CurrencyContract
{
    public function __construct(Currency $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function add($request)
    {
        $this->forget($request);

        return parent::add($request);
    }

    public function update($request)
    {
        $this->forget($request);

        return parent::update($request);
    }

    public function destroy($request)
    {
        $this->forget($request);

        return parent::destroy($request);
    }

    public function active($request)
    {
        $this->forget($request);

        return parent::active($request);
    }

    public function passive($request)
    {
        $this->forget($request);

        return parent::passive($request);
    }

    public function forget($request)
    {
        $request->session()->forget('localization.currency.admin');
        $request->session()->forget('localization.currency.site');

        Cache::forget('currencies');
    }

    public function cacheRows()
    {
        return Cache::rememberForever('currencies', function() {
            return $this->activeOrderRows();
        });
    }
}