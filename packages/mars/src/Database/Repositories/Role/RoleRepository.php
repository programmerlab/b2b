<?php

namespace Ribrit\Mars\Database\Repositories\Role;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Database\Models\Role\Role;
use Ribrit\Mars\Database\Models\Route\Route;
use Ribrit\Mars\Database\Repositories\Repository;

class RoleRepository extends Repository implements RoleContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'text',
        'texts',
        'mainmenu',
        'addmenu',
        'access',
        'accessRoute'
    ];

    public function __construct(Role $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function codeFind($code)
    {
        return $this->model->whereCode($code)->first();
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);
        $this->addRelationAccess($row, $request->access);
        $this->addRelationAccessRoute($row, $request->routeAccess);
        $this->addRoleRoute($row, setting('system.role_route_id'), $request);

        $this->forgetCache($row->id);

        return $row;
    }

    public function addRelationAccess($row, $access = [])
    {
        foreach ((array)$access as $key => $value) {
            $row->access()->create([
                'position' => $key,
                'status'   => $value ? 'yes' : 'no'
            ]);
        }
    }

    public function addRelationAccessRoute($row, $access)
    {
        foreach (explode(',', $access) as $id) {

            if (!$id) {
                continue;
            }

            $row->accessRoute()->create([
                'route_link_id' => $id,
                'status'        => 'yes'
            ]);
        }
    }

    protected function addRoleRoute($row, $parentId, $request)
    {
        $url    = 'admin/user/group/'.$row->code;
        $fields = [
            'group_id'    => config('groups.route.admin.id'),
            'parent_id'   => $parentId,
            'methods'     => 'index,create,edit,add,update,active,passive,destroy',
            'name'        => 'userRole' . ucfirst($row->code),
            'controller'  => 'UserRole',
            'lang_path'   => 'user.employee',
            'layout_path' => 'user.employee',
            'layout_id'   => 0
        ];

        return app(RouteContract::class)->addCodeRoute($request, $row, $url, $fields);
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $row->access()->delete();
        $row->accessRoute()->delete();

        $this->addRelationText($row, $request->texts);
        $this->addRelationAccess($row, $request->access);
        $this->addRelationAccessRoute($row, $request->routeAccess);

        $this->forgetCache($row->id);

        return $row;
    }

    public function destroy($request)
    {
        $destroy = parent::destroy($request);

        $this->forgetCache($request->id);

        return $destroy;
    }

    public function getAccessFields()
    {
        return yaml_parsed(base_path('database/accessories/role.yml'))['access'];
    }

    public function getAccessRoute($id, $methods)
    {
        $name = lang('id') . '-' . $id . '-' . join('-', $methods);

        return Cache::rememberForever('roleAccess-' . $name, function () use ($id, $methods) {

            if (!$row = $this->row($id)) {
                return null;
            }

            $methods = $row->accessRoute()->whereIn('route_link_id', $methods)->get();

            $row->setAttribute('accessRoute', $methods);

            return $row;
        });
    }

    public function allRoute($id)
    {
        return Cache::rememberForever('accessRoute-' . $id, function () use ($id) {

            $role = $this->row($id);

            return array_el_to_key($role->accessRoute->toArray(), 'route_link_id');
        });
    }

    protected function forgetCache($id)
    {
        foreach (config('langs') as $lang) {

            foreach (Route::get() as $route) {

                $name = $lang['id'] . '-' . $id . '-' . join('-', array_el_to_el($route->links, 'id'));

                Cache::forget('roleAccess-' . $name);
            }
        }

        Cache::forget('accessRoute-' . $id);
    }
}