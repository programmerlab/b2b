<?php

namespace Ribrit\Tenant\Database\Repositories\Status;

use Ribrit\Mars\Database\Repositories\Repository;
use Illuminate\Support\Facades\Cache;
use Ribrit\Tenant\Database\Contracts\Status\StatusContract;
use Ribrit\Tenant\Database\Models\Status\Status;

class StatusRepository extends Repository implements StatusContract
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

    public function __construct(Status $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function rows()
    {
        return $this->model
            ->with($this->with)
            ->orderBy('row', 'asc')
            ->orderBy('created_at', 'desc')
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

    public function cacheGroups()
    {
        return Cache::rememberForever(cache_name('status-' . lang('id')), function () {
            return $this->groups();
        });
    }

    protected function groups()
    {
        $data = [];

        foreach ($this->rows() as $row) {
            $data[ $row->group->code ][ $row->id ] = $row->toArray();
        }

        return $data;
    }

    public function forgetCache($request)
    {
        foreach (config('langs') as $lang) {
            Cache::forget(cache_name('status-' . $lang['id']));
        }
    }
}