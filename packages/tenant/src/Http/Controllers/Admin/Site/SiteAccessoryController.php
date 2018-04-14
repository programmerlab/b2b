<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Site;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Draft\DraftContract;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;
use Ribrit\Tenant\Http\Requests\Admin\Site\Accessory\SiteAccessoryIndexRequest as IndexRequest;
use Ribrit\Tenant\Http\Requests\Admin\Site\Accessory\SiteAccessoryUpdateRequest as UpdateRequest;

class SiteAccessoryController extends AdminController
{
    public function __construct(SiteContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request, ThemeContract $theme, DraftContract $draft)
    {
        $this->setRouteMethod();

        return $this->layout([
            'drafts'     => $draft->groupRows(config('groups.draft.email.id')),
            'siteThemes' => $theme->groupRows(config('groups.theme.site.id')),
            'row'        => $this->contract->row($request->site)
        ]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->updateAccessories($request);

        return $this->crudMessage($request);
    }

    protected function setRouteMethod()
    {
        $current                  = $this->appRouter->current;
        $current['code']          = 'edit';
        $this->appRouter->current = $current;
        Request::setRouter($this->appRouter);
    }
}