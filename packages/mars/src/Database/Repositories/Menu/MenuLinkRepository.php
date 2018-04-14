<?php

namespace Ribrit\Mars\Database\Repositories\Menu;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Menu\MenuLinkContract;
use Ribrit\Mars\Helpers\TreeMenuHelper;
use Ribrit\Mars\Database\Models\Menu\MenuLink;
use Ribrit\Mars\Database\Repositories\Repository;

class MenuLinkRepository extends Repository implements MenuLinkContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'accessories',
        'text',
        'texts'
    ];

    public $nestLayout = 'admin::admin.menu.menu.link.nestable';

    public function __construct(MenuLink $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function getTreeMenu($menuId, $router)
    {
        $rows = $this->model->where('menu_id', $menuId)
            ->with($this->with)
            ->orderBy('parent_id', 'asc')
            ->orderBy('row', 'asc')
            ->get();

        $tree         = new TreeMenuHelper();
        $tree->layout = $this->nestLayout;

        return $tree->render($rows, 0, ['appRouter' => $router]);
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);
        $this->addRelationAccessory($row, $request->accessory);

        $this->forgetCache($row->menu_id, $request);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $row->accessories()->delete();

        $this->addRelationText($row, $request->texts);
        $this->addRelationAccessory($row, $request->accessory);

        $this->forgetCache($row->menu_id, $request);

        return $row;
    }

    public function destroyChild($request)
    {
        $row = parent::destroyChild($request);

        $this->forgetCache($row->menu_id, $request);

        return $row;
    }

    public function changeRow($request)
    {
        $row = parent::changeRow($request);

        $this->row($request->menu_id);

        $this->forgetCache($request->menu_id, $request);

        return $row;
    }

    public function forgetCache($menuId, $request)
    {
        foreach (config('langs') as $lang) {
            Cache::forget('menu-'.$lang['id'].'-'.$menuId);
        }
    }
}