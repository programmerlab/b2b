<?php

namespace Ribrit\Mars\Database\Repositories\Lang;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Lang\LangContract;
use Ribrit\Mars\Database\Models\Lang\Lang;
use Ribrit\Mars\Database\Repositories\Repository;

class LangRepository extends Repository implements LangContract
{
    public function __construct(Lang $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function inRows($langs)
    {
        $langs = explode(',', $langs);
        $data  = [];

        foreach ($this->cacheRows() as $row) {
            if (!in_array($row->id, $langs)) continue;
            $data[ $row->id ] = $row;
        }

        return $data;
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
        $request->session()->forget('localization.lang.admin');
        $request->session()->forget('localization.lang.site');

        Cache::forget('langs');
        Cache::forget(cache_name('langs'));
    }

    public function cacheRows()
    {
        return Cache::rememberForever('langs', function() {
            return $this->activeOrderRows();
        });
    }

    public function cacheTenantRows($langs)
    {
        return Cache::rememberForever(cache_name('langs'), function() use($langs) {
            return $this->inRows($langs);
        });
    }
}