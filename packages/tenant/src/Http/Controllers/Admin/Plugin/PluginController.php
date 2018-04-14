<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Plugin;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Component\PluginContract;
use Ribrit\Tenant\Http\Requests\Admin\Plugin\PluginAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Plugin\PluginDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Plugin\PluginUpdateRequest as UpdateRequest;

class PluginController extends AdminController
{
    public function __construct(PluginContract $contract)
    {
        parent::__construct();

        $this->contract     = $contract;
        $this->jsonFormData = [
            'trigger' => [
                '#modalUrl .close'
            ]
        ];
    }

    public function getIndex()
    {
        $this->setRouterMethod();

        return $this->layout([
            'rows' => $this->contract->groupPaginate($this->appGroup->id)
        ]);
    }

    public function getCreate()
    {
        return $this->layout([
            'rows' => $this->contract->getGroupPlugins($this->appGroup->code)
        ]);
    }

    public function getEdit($group, $id)
    {
        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        Request::unSetRouterMethod('create');

        $this->metaData = [
            'title' => ucfirst($row['name'])
        ];

        return $this->layout(array_merge([
            'plugin_layout' => $this->getPluginLayout($row),
            'sites'         => array_el_to_key($row->sites, 'site_id'),
            'config'        => $this->contract->groupPlugin($group, $row->name),
            'row'           => $row
        ], plugin_run_service($row, 'Admin')));
    }

    public function postAdd(AddRequest $request)
    {
        $row = $this->contract->add($request);

        return $this->crudMessage($request, ['id' => $row->id]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    protected function getPluginLayout($row)
    {
        $path = 'admin::plugins.' . $row['group_code'] . '.' . $row['name'] . '.' . $this->appRouter->current['code'];

        if (!view()->exists($path)) {
            return 'misc.empty';
        }

        return $path;
    }

    protected function setRouterMethod()
    {
        Request::setRouterMethod([
            'create' => [
                'modal' => route_modal_url($this->appRouter->methods['create']['url'])
            ]
        ]);
    }
}