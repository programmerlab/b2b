<?php

namespace Ribrit\Mars\Database\Repositories\Menu;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Menu\MenuContract;
use Ribrit\Mars\Database\Models\Menu\Menu;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Mars\Helpers\TreeMenuHelper;

class MenuRepository extends Repository implements MenuContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'text',
        'texts',
        'links',
        'links.accessories',
        'links.text'
    ];
    
    protected $treePath = 'admin::';

    public function __construct(Menu $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $this->addRelationText($row, $request->texts);

        return $row;
    }

    public function cacheComponentTreeMenu($current, $menuId)
    {
        return Cache::rememberForever('menu-' . lang('id') . '-' . $menuId, function () use ($current, $menuId) {

            $menu    = $this->treeMenuLinks($menuId);

            if (!$menu->layout_path) {
                return null;
            }

            $layouts = explode(',', $menu->layout_path);
            $layout  = $this->treeMenuLayouts($layouts, $menu->links, 0);

            return $layout;
        });
    }

    protected function treeMenuLinks($id)
    {
        return $this->model
            ->with([
                'links' => function($query) {
                    $query->orderBy('parent_id', 'asc');
                    $query->orderBy('row', 'asc');
                }
            ])
            ->find($id);
    }

    protected function treeMenuLayouts($layouts, $links, $parent)
    {
        $tree            = new TreeMenuHelper();
        $tree->namespace = $this->treePath;
        $tree->layout    = $layouts;

        return $tree->renderLayouts($links, $parent);
    }
}