<?php

namespace Ribrit\Mars\Database\Repositories\Route;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Database\Models\Route\Route;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Mars\Helpers\TreeMenuHelper;

class RouteRepository extends Repository implements RouteContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'group',
        'group.text',
        'text',
        'texts',
        'link',
        'link.text',
        'mainLink',
        'mainLink.text',
        'links',
        'links.text',
        'links.method',
        'childs',
        'childs.mainLink',
        'childs.mainLink.text',
        'parent',
        'parent.childs',
        'parent.childs.text',
        'parent.childs.mainLink',
        'parent.childs.mainLink.text',
        'parents',
        'parents.text'
    ];

    public function __construct(Route $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function roleRows()
    {
        return $this->model
            ->orderBy('row', 'asc')
            ->orderBy('parent_id', 'asc')
            ->with($this->with)
            ->get();
    }

	public function roleGroupRows($groupId)
	{
		return $this->model
			->where('group_id', $groupId)
			->orderBy('row', 'asc')
			->orderBy('parent_id', 'asc')
			->with($this->with)
			->get();
	}

    public function getGroupTreeMenu($group, $router)
    {
        $rows         = $this->model->where('group_id', $group->id)->with($this->with)->orderBy('row', 'asc')->get();
        $tree         = new TreeMenuHelper();
        $tree->layout = 'admin::admin.mars.route.nestable';

        return $tree->render($rows, 0, ['appRouter' => $router]);
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);
        $this->addRelationLinks($row, $request);

        $this->forgetCache($row, $request);

        return $row;
    }

    public function addRelationLinks($row, $request)
    {
        foreach (explode(',', $request->methods) as  $key => $method) {
            if (!$method = config('route.methods.'.$method)) {
                continue;
            }

            $routeLink = $row->links()->create([
                'route_method_id' => $method['id'],
                'main'            => $key == 0 ? 'yes' : 'no'
            ]);

            $this->addRelationLinkAccess($routeLink);
            $this->addRelationLinkTexts($routeLink, $method, $request->texts);
        }

        Cache::forget('accessRoute-' . $this->user->role->role_id);
    }

    public function addRelationLinkAccess($row)
    {
        $row->access()->create([
            'status'  => 'yes',
            'role_id' => $this->user->role->role_id
        ]);
    }

    public function addRelationLinkTexts($row, $method, $texts)
    {
        foreach ($texts as $langId => $text) {

            if ($method['code'] != 'index') {
                $text['url'] = $text['url'].'/'.$method['code'];
            }

            $row->texts()->create([
                'lang_id' => $langId,
                'url'     => $text['url']
            ]);
        }
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $row->links()->delete();

        $this->addRelationText($row, $request->texts);
        $this->addRelationLinks($row, $request);

        $this->forgetCache($row, $request);

        return $row;
    }

    public function destroyChild($request)
    {
        $this->forgetCache($this->row($request->id), $request);

        return parent::destroyChild($request);
    }

    public function forgetCache($row, $request)
    {
        foreach (config('langs') as $lang) {
            Cache::forget('routeNames-'.$lang['id']);

            foreach ($this->rows() as $route) {
                Cache::forget('route'.ucfirst($route->name).'-'.$lang['id']);
            }
        }
    }

    public function cacheGetName()
    {
        return Cache::rememberForever('routeNames-'.lang('id'), function() {
            return $this->getName();
        });
    }

    protected function getName()
    {
        $data = $this->model->orderBy('parent_id', 'asc')->orderBy('row', 'asc')->with($this->with)->get();
        $rows = [];

        foreach ($data as $route) {
            foreach ($route->links as  $link) {
                $rows[ $route->name . ucfirst($link->method->method) . ucfirst($link->method->code) ] = [
                    'url'      => $link->text->url,
                    'route'    => $route->text->toArray(),
                    'original' => $link->toArray()
                ];
            }
        }

        return $rows;
    }

    public function dropdown()
    {
        return (new TreeMenuHelper())->renderDropdown($this->rows(), 0);
    }

    public function cacheFindName($name)
    {
        return Cache::rememberForever('route'.ucfirst($name).'-'.lang('id'), function() use($name) {

            if (!$row = $this->findName($name)) {
                return null;
            }

            $row->setAttribute('methods', $this->createLinksMethod($row->links, $row->name));

            return $row;
        });
    }

    protected function findName($name)
    {
        $this->with['parent.childs'] = function($query) {
            $query->orderBy('parent_id', 'asc');
            $query->orderBy('row', 'asc');
        };

        return $this->model
            ->whereName($name)
            ->with($this->with)
            ->first();
    }

    protected function createLinksMethod($links, $name)
    {
        $data = [];

        foreach ($links as $link) $data [$link->method->code] = $this->createLinkMethod($link, $name);

        return $data;
    }

    protected function createLinkMethod($link, $name)
    {
        return [
            'id'       => $link->id,
            'as'       => $name . ucfirst($link->method->method) . ucfirst($link->method->code),
            'name'     => $name . ucfirst($link->method->code),
            'method'   => $link->method->method,
            'code'     => $link->method->code,
            'url'      => $this->createLinkUrl($link),
            'title'    => $link->method->text->title,
            'original' => $link->toArray(),
        ];
    }

    protected function createLinkUrl($link)
    {
        if ($link->method->code == 'index') {
            return $link->text->url;
        }

        return str_replace($link->method->text->name, $link->method->code, $link->text->url);
    }

    public function addCodeRoute($request, $row, $url, $fields)
    {
        $fields['texts'] = [];

        foreach ($row->texts as $text) {
            $fields['texts'][ $text->lang_id ] = [
                'title' => $text->title,
                'url'   => $url . '/' . $row->code,
            ];
        }

        return $this->add($this->setRequest($request, $fields));
    }
}