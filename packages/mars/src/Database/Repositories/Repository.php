<?php

namespace Ribrit\Mars\Database\Repositories;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Ribrit\Mars\Database\Contracts\Contract;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Helpers\TreeMenuHelper;

abstract class Repository implements Contract
{
    use CacheTrait;

    /**
     * Database class
     *
     * @var object
     */
    protected $model;

    /**
     * Login user
     *
     * @var objcet
     */
    protected $user;

    /**
     * Pagination limit
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [//
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function rows()
    {
        return $this->model->with($this->with)->orderBy('created_at', 'desc')->get();
    }

    public function activeRows()
    {
        return $this->model->with($this->with)->orderBy('created_at', 'desc')->get();
    }

    public function activeOrderRows()
    {
        return $this->model->active()->with($this->with)->orderBy('row', 'asc')->get();
    }

    public function groupRows($groupId)
    {
        return $this->model->where('group_id', $groupId)->with($this->with)->orderBy('created_at', 'desc')->get();
    }

    public function groupActiveRows($groupId)
    {
        return $this->model->where('group_id', $groupId)->with($this->with)->orderBy('created_at', 'desc')->active()
            ->get();
    }

    public function groupActiveOrderRows($groupId)
    {
        return $this->model->where('group_id', $groupId)->with($this->with)->active()->orderBy('row', 'asc')
            ->orderBy('created_at', 'desc')->get();
    }

    public function paginate()
    {
        return $this->model->with($this->with)->orderBy('created_at', 'desc')->paginate($this->perPage);
    }

    public function groupPaginate($groupId)
    {
        return $this->model->where('group_id', $groupId)->with($this->with)->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    public function orderByParentRows($parentId)
    {
        return $this->model->with($this->with)->where('parent_id', $parentId)->orderBy('parent_id', 'asc')->get();
    }

    public function row($id)
    {
        return $this->model->with($this->with)->find($id);
    }

    public function groupRow($id, $groupId)
    {
        return $this->model->where('group_id', $groupId)->with($this->with)->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->with($this->with)->findOrFail($id);
    }

    public function add($request)
    {
        return $this->model->create($request->all());
    }

    public function storeManually($data)
    {
        return $this->model->create($data);
    }

    public function addRelation($row, $method, $fields)
    {
        if (!is_array($fields)) {
            return false;
        }

        foreach ($fields as $field) {
            $row->{$method}()->create($field);
        }
    }

    public function addRelationText($row, $texts, $type = '')
    {
        foreach ($texts as $langId => $text) {
            $text[ $type . 'lang_id' ] = $langId;
            $row->texts()->create($text);
        }
    }

    public function addRelationAccessory($row, $accessories = [])
    {
        if (!$accessories) {
            return null;
        }

        foreach ($accessories as $key => $value) {
            $row->accessories()->create([
                'key'   => $key,
                'value' => is_array($value) ? json_encode($value) : $value
            ]);
        }
    }

    public function accessoryUpdateOrStore($item, $accessories = [])
    {
        if (!$accessories) {
            return $item;
        }

        foreach ($accessories as $key => $value) {

            if (is_array($value)) {
                continue;
            }

            if ($accessory = $item->accessories()->where('key', $key)->first()) {
                $accessory->update([
                    'value' => $value
                ]);
            } else {
                $item->accessories()->create([
                    'key'   => $key,
                    'value' => $value
                ]);
            }
        }

        return $item;
    }

    public function addRelationStringMany($row, $fields, $id)
    {
        foreach (explode(',', $fields) as $field) {

            if (!$field) {
                continue;
            }

            $row->create([$id => $field]);
        }
    }

    public function update($request)
    {
        $row = $this->findOrFail($request->id);

        $row->fill($request->all())->save();

        return $row;
    }

    public function destroy($request)
    {
        $ids = explode(',', $request->id);

        if (count($ids) > 1) {
            return $this->model->destroy($ids);
        }

        if (!$row = $this->row($request->id)) {
            return false;
        }

        $row->delete();

        return $row;
    }

    public function destroyChild($request)
    {
        $data = new TreeMenuHelper();
        $data->renderChild($this->rows(), $request->id);

        $this->model->destroy($data->childsData);

        return $this->destroy($request);
    }

    public function active($request)
    {
        return $this->findOrFail($request->id)->fill(['active' => 'yes'])->save();
    }

    public function passive($request)
    {
        return $this->findOrFail($request->id)->fill(['active' => 'no'])->save();
    }

    public function changeRow($request)
    {
        $rows = (new TreeMenuHelper())->renderJson(json_decode($request['json'], true));

        foreach ($rows as $key => $value) {
            $this->model->whereId($value['id'])->update([
                'parent_id' => $value['parent'],
                'row'       => $key + 1
            ]);
        }
    }

    protected function getExcelData($file)
    {
        return Excel::load($file)->get()->toArray();
    }

    public function setWith($with)
    {
        $this->with = array_merge($this->with, $with);
    }

    public function setRequest($request = null, $fields)
    {
        if (!$request) {
            $request = request();
        }

        foreach ($fields as $key => $value) {
            $request->offsetSet($key, $value);
        }

        return $request;
    }

    public function total()
    {
        return $this->model->count();
    }

    public function searchFirst($data, $column = 'title')
    {
        return $this->model->where($column, 'like', '%' . $data . '%')->with($this->with)->first();
    }

    public function textSearchFirst($data, $column = 'title')
    {
        return $this->model->whereHas('texts', function ($query) use ($data, $column) {
            $query->where($column, 'like', '%' . $data . '%');
        })->with($this->with)->first();
    }
}