<?php

namespace Ribrit\Mars\Database\Repositories\Zone;

use Ribrit\Mars\Database\Contracts\Zone\ZoneContract;
use Ribrit\Mars\Database\Models\Zone\Zone;
use Ribrit\Mars\Database\Repositories\Repository;

class ZoneRepository extends Repository implements ZoneContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'group',
        'text',
        'texts',
        'currency',
        'currency.currency',
        'childs',
        'childs.text',
        'parent.text',
        'parent.parent',
        'parent.parent.text',
        'parent.parent.parent',
        'parent.parent.parent.text',
        'parent.parent.parent.parent',
        'parent.parent.parent.parent.text',
    ];

    public function __construct(Zone $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function groupRequestPaginate($groupId, $request)
    {
        return $this->model
            ->where('group_id', $groupId)
            ->whereHas('text', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->title . '%');
            })
            ->with($this->with)
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    public function groupRows($groupId)
    {
        return $this->model
            ->join('zone_text', 'zone.id', '=', 'zone_text.zone_id')
            ->where('zone.group_id', $groupId)
            ->where('zone_text.lang_id', lang('id'))
            ->select('zone.*', 'zone_text.title')
            ->orderBy('zone.row', 'asc')
            ->orderBy('zone_text.title', 'asc')
            ->orderBy('zone.created_at', 'desc')
            ->with($this->with)
            ->get();
    }

    public function parentRows($parentId)
    {
        return $this->model
            ->join('zone_text', 'zone.id', '=', 'zone_text.zone_id')
            ->where('zone.parent_id', $parentId)
            ->where('zone_text.lang_id', lang('id'))
            ->select('zone.*', 'zone_text.title')
            ->orderBy('zone.row', 'asc')
            ->orderBy('zone_text.title', 'asc')
            ->orderBy('zone.created_at', 'desc')
            ->with($this->with)
            ->get();
    }

    public function inRows($ids)
    {
        return $this->model
            ->join('zone_text', 'zone.id', '=', 'zone_text.zone_id')
            ->whereIn('zone.id', $ids)
            ->where('zone_text.lang_id', lang('id'))
            ->select('zone.*', 'zone_text.title')
            ->orderBy('zone.row', 'asc')
            ->orderBy('zone_text.title', 'asc')
            ->orderBy('zone.created_at', 'desc')
            ->with($this->with)
            ->get();
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);
        $this->addRelationCurrency($row, $request->currency_id);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();
        $row->currency()->delete();

        $this->addRelationText($row, $request->texts);
        $this->addRelationCurrency($row, $request->currency_id);

        return $row;
    }

    protected function addRelationCurrency($row, $id)
    {
        if (!$id) {
            return null;
        }

        return $row->currency()->create(['currency_id' => $id]);
    }
}