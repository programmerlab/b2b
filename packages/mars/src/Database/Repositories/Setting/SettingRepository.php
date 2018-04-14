<?php

namespace Ribrit\Mars\Database\Repositories\Setting;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Setting\SettingContract;
use Ribrit\Mars\Database\Models\Setting\Setting;
use Ribrit\Mars\Database\Repositories\Repository;

class SettingRepository extends Repository implements SettingContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'accessories'
    ];

    public function __construct(Setting $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function onlyGroupRow($groupId)
    {
        return $this->model
            ->where('group_id', $groupId)
            ->first();
    }

    public function update($request)
    {
        $row = parent::update($request);

        $row->accessories()->delete();

        $this->addRelationAccessory($row, $request->accessory);

        $this->forgetCache($request);

        return $row;
    }

    public function cache()
    {
        return Cache::rememberForever('setting', function() {

            $data = [];

            foreach ($this->rows() as $row) $data[ $row->code ] = $row->toArray();

            return $data;
        });
    }

    public function forgetCache($request)
    {
        return Cache::forget('setting');
    }
}