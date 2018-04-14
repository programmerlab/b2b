<?php

namespace Ribrit\Tenant\Database\Repositories\Menu;

use Ribrit\Mars\Helpers\TreeMenuHelper;
use Ribrit\Mars\Database\Repositories\Menu\MenuRepository;
use Ribrit\Tenant\Database\Contracts\Menu\TenantMenuContract;
use Ribrit\Tenant\Database\Models\Menu\TenantMenu;

class TenantMenuRepository extends MenuRepository implements TenantMenuContract
{
    protected $treePath = 'site::';

    public function __construct(TenantMenu $model)
    {
        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    protected function treeMenu($layout, $links, $parent)
    {
        $tree         = new TreeMenuHelper();
        $tree->layout = $layout;

        return $tree->render($links, $parent);
    }
}