<?php

namespace Ribrit\Tenant\Database\Repositories\Component;

use Ribrit\Tenant\Database\Contracts\Component\PluginContract;
use Ribrit\Tenant\Database\Models\Component\Plugin;

class PluginRepository extends ComponentRepository implements PluginContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'group',
        'site',
    ];

    public function __construct(Plugin $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
    
    public function add($request)
    {
        $this->setRequest($request, $this->groupPlugin($request->group, $request->name)['info']);

        $row = parent::add($request);
        $this->installMix($row);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->sites()->delete();

        $this->addRelationSites($row, $request->site);

        return $row;
    }

    protected function addRelationSites($row, $sites)
    {
        foreach ($sites as $site) {
            $rowSite = $row->sites()->create($site);
            $this->addRelationAccessory($rowSite, !empty($site['accessory']) ? $site['accessory'] : []);
        }
    }

    public function destroy($request)
    {
        $row =  parent::destroy($request);
        $this->uninstallMix($row);
        
        return $row;
    }
}