<?php

namespace Ribrit\Mars\Database\Repositories\Group;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Group\GroupContract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Database\Models\Group\Group;
use Ribrit\Mars\Database\Repositories\Repository;

class GroupRepository extends Repository implements GroupContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'text',
		'texts',
		'parent',
		'parent.text',
		'parents',
		'parents.text',
	];

	public function __construct(Group $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function parentPaginate($parentId)
	{
		return $this->model->where('parent_id', $parentId)->with($this->with)->orderBy('created_at',
				'desc')->paginate($this->perPage);
	}

	public function add($request)
	{
		$row = parent::add($request);
		$this->addRelationText($row, $request->texts);
		$this->addGroupRoute($row, setting('system.group_route_id'), $request);

		$this->forget($request);

		return $row;
	}

	protected function addGroupRoute($row, $parentId, $request)
	{
		if ($row->parent_id > 0) {
			return false;
		}

		$url = 'admin/development/group';
		$fields = [
			'group_id'    => config('groups.route.admin.id'),
			'parent_id'   => $parentId,
			'methods'     => 'index,create,edit,add,update,destroy',
			'name'        => 'group' . ucfirst($row->code),
			'controller'  => 'Group',
			'lang_path'   => 'group',
			'layout_path' => 'group',
			'layout_id'   => 0
		];

		return app(RouteContract::class)->addCodeRoute($request, $row, $url, $fields);
	}

	public function update($request)
	{
		$row = parent::update($request);
		$row->texts()->delete();

		$this->addRelationText($row, $request->texts);
		$this->forget($request);

		return $row;
	}

	public function destroy($request)
	{
		$this->forget($request);

		return parent::destroy($request);
	}

	public function forget($request)
	{
		foreach (config('langs') as $lang) {
			Cache::forget('groups-' . $lang['id']);
		}
	}

	public function cacheParents()
	{
		return Cache::rememberForever('groups-' . lang('id'), function () {
			return $this->parents();
		});
	}

	protected function parents()
	{
		$rows = [];

		foreach ($this->rows() as $row) {

			if ($row->parent_id != 0) {
				if (!$row->parent) {
					continue;
				}
			}

			$rows[ $row->parent_id == 0 ? 'main' : $row->parent->code ][ $row->code ] = $row;
		}

		return $rows;
	}
}