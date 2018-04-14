<?php

namespace Ribrit\Tenant\Database\Repositories\Menu;

use Ribrit\Mars\Helpers\TreeMenuHelper;
use Ribrit\Mars\Database\Repositories\Menu\MenuLinkRepository;
use Ribrit\Tenant\Database\Contracts\Menu\TenantMenuLinkContract;
use Ribrit\Tenant\Database\Models\Menu\TenantMenuLink;

class TenantMenuLinkRepository extends MenuLinkRepository implements TenantMenuLinkContract
{
    public function __construct(TenantMenuLink $model)
    {
        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function getTreeMenu($menuId, $router)
    {
        $rows = $this->model->where('tenant_menu_id', $menuId)
            ->with($this->with)
            ->orderBy('parent_id', 'asc')
            ->orderBy('row', 'asc')
            ->get();

        $tree         = new TreeMenuHelper();
        $tree->layout = $this->nestLayout;

        return $tree->render($rows, 0, ['appRouter' => $router]);
    }
}