<?php

namespace Ribrit\Mars\Database\Repositories\Layout;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Layout\LayoutContract;
use Ribrit\Mars\Database\Models\Layout\Layout;
use Ribrit\Mars\Database\Repositories\Repository;

class LayoutRepository extends Repository implements LayoutContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'text',
        'texts'
    ];

    public function __construct(Layout $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function rowRows()
    {
        return $this->model
            ->with($this->with)
            ->orderBy('row', 'asc')
            ->get();
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);

        $this->forgetCache($request);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();

        $this->addRelationText($row, $request->texts);

        $this->forgetCache($request);

        return $row;
    }

    public function destroy($request)
    {
        $destoy = parent::destroy($request);

        $this->forgetCache($request);

        return $destoy;
    }

    public function cacheCode()
    {
        return Cache::rememberForever('layouts-'.lang('id'), function() {
            return $this->code();
        });
    }

    protected function code()
    {
        $data = [];

        foreach ($this->rowRows() as $row) {
            $data[ $row->code ] = $row->toArray();
        }

        return $data;
    }

    public function forgetCache($request)
    {
        foreach (config('langs') as $lang) {
            Cache::forget('layouts-'.$lang['id']);
        }
    }
}