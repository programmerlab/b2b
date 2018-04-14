<?php

namespace Ribrit\Mars\Database\Repositories\Definition;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Mars\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Mars\Database\Models\Definition\Definition;

class DefinitionRepository extends Repository implements DefinitionContract
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

    public function __construct(Definition $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function titleGroupFirst($groupId, $title)
    {
        return $this->model
            ->where('group_id', $groupId)
            ->whereHas('texts', function($query) use($title) {
                $query->where('title', $title);
            })
            ->with($this->with)
            ->first();
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);
        $this->addRelationAccessory($row, $request->accessory);

        $this->forget($request);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $row->accessories()->delete();

        $this->addRelationText($row, $request->texts);
        $this->addRelationAccessory($row, $request->accessory);

        $this->forget($request);

        return $row;
    }

    public function destroy($request)
    {
        $this->forget($request);

        return parent::destroy($request);
    }

    public function cacheGroups()
    {
        return Cache::rememberForever('definitions-'.lang('id'), function() {
            return $this->groups();
        });
    }

    public function forget($request)
    {
        foreach (config('langs') as $lang) {
            Cache::forget('definitions-'.$lang['id']);
        }
    }

    protected function groups()
    {
        $data = [];

        foreach ($this->rows() as $row) {
            $data[ $row->group->code ][ $row->id ] = $row->toArray();
        }

        return $data;
    }
}