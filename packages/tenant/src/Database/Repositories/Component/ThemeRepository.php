<?php

namespace Ribrit\Tenant\Database\Repositories\Component;

use Illuminate\Support\Facades\Cache;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;
use Ribrit\Tenant\Database\Models\Component\Theme;

class ThemeRepository extends ComponentRepository implements ThemeContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'accessories',
        'group',
    ];

    public function __construct(Theme $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function childs($request)
    {
        return $this->model->where('parent_id', $request['id'])->count();
    }

    public function add($request)
    {
        $info = $this->groupTheme($request->group, $request->name)['info'];
        $this->setRequest($request, $info);

        return parent::add($request);
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->accessories()->delete();

        $this->addRelationAccessory($row, $request->accessory);

        $this->createOrUpdateRelationSites($row, $request->site);

        $this->forgetCache($row, $request);

        return $row;
    }

    protected function createOrUpdateRelationSites($row, $sites = [])
    {
        if (!$sites) {
            return null;
        }

        foreach ($sites as $data) {

            if ($site = $row->sites()->where('site_id', $data['site_id'])->first()) {
                $row->fill($data)->save();
            } else {
                $site = $row->sites()->create($data);
            }

            $site->accessories()->delete();
            $this->addRelationAccessory($site, $data['accessory']);

            $this->createOrUpdateRelationLayouts($site, $data['layouts']);
        }
    }

    protected function createOrUpdateRelationLayouts($site, $layouts)
    {
        foreach ($layouts as $data) {

            if ($layout = $site->layouts()->where('layout_id', $data['layout_id'])->first()) {
                $layout->fill($data)->save();
            } else {
                $layout = $site->layouts()->create($data);
            }
        }
    }

    public function cacheTheme($id)
    {
        return Cache::rememberForever('theme-' . $id, function() use ($id) {

            $this->with = [];

            if (!$row = $this->row($id)) {
                return null;
            }

            $data           = $row->toArray();
            $data['config'] = $this->groupTheme($row->group_code, $row->name);

            return $data;
        });
    }

    public function cacheSiteTheme($site)
    {
        return Cache::rememberForever('theme-' . $site['id'] . '-' . $site['theme'], function () use ($site) {

            $row = $this->model
                ->whereHas('site', function($query) use($site) {
                    $query->where('site_id', $site['id']);
                })
                ->find($site['theme']);

            if (!$row) {
                return null;
            }

            $theme           = array_merge($row->toArray(), $row->site->toArray());
            $theme['config'] = $this->groupTheme($row->group_code, $row->name);

            return $theme;
        });
    }

    public function forgetCache($row, $request)
    {
        Cache::forget('theme-' . $row->id);

        foreach (tenant('sites') as $site) {
            Cache::forget('theme-' . $site['id'] . '-' . $row->id);
        }
    }
}