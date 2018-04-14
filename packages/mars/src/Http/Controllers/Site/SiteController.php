<?php

namespace Ribrit\Mars\Http\Controllers\Site;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Controller;
use Ribrit\Tenant\Database\Contracts\Component\ThemeSiteLayoutContract;
use Ribrit\Tenant\Services\PluginService;

abstract class SiteController extends Controller
{
    protected $appSeoLink;

    protected $addons = true;

    public function __construct()
    {
        parent::__construct();

        $this->appSeoLink = Request::getSeoLink();
        $this->setSiteMetaData();
    }

    protected function createLayoutPath()
    {
        $this->data['content_layout_path'] = join('.', [
            $this->pathNamespace . $this->appRouter->group->code,
            $this->appRouter->layout_path,
            $this->layoutCode ? $this->layoutCode : $this->appRouter->current['code']
        ]);

        if ($this->addons) {
            $this->pathLayout = $this->pathNamespace . 'layout.content';
        } else {
            $this->pathLayout = $this->data['content_layout_path'];
        }
    }

    protected function setSeoLinkMetaData()
    {
        $this->metaData = $this->appSeoLink->toArray();
    }

    protected function setSiteMetaData()
    {
        $this->metaData = [
            'title'       => tenant_site('meta_title.' . lang('id')),
            'description' => tenant_site('meta_description.' . lang('id')),
            'keywords'    => tenant_site('meta_keywords.' . lang('id')),
        ];
    }

    protected function defaultData()
    {
        parent::defaultData();
        $this->data['containers'] = $this->addonsLoad();
    }

    protected function addonsLoad()
    {
        if ($this->appRouter->layout_id && $this->addons == true) {
            return $this->moduleAddonsLoad();
        }

        return [];
    }

    protected function moduleAddonsLoad()
    {
        $module         = new PluginService();
        $module->theme  = theme();
        $module->layout = app(ThemeSiteLayoutContract::class)->siteRow($module->theme['id'], $this->appRouter->layout_id);

        return $module->layout ? $module->load() : [];
    }
}