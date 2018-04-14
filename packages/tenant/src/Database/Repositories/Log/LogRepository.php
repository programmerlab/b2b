<?php

namespace Ribrit\Tenant\Database\Repositories\Log;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Log\LogContract;
use Ribrit\Tenant\Database\Models\Log\Log;

class LogRepository extends Repository implements LogContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'route',
        'route.route',
        'route.route.text',
        'process'
    ];

    public function __construct(Log $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function requestPaginate($request)
    {
        return $this->model
            ->with($this->with)
            ->where(function($query) use($request) {
                if ($request->path) {
                    $query->where('path', $request->path);
                }

                if ($request->user) {
                    $query->where('user', $request->user);
                }

                if ($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    public function addRoute($request)
    {
        $user = $request->user();

        $row = $this->model->create([
            'user_id'    => $user ? $user->id : 0,
            'user'       => $user ? $user->name : 'Guest',
            'path'       => $request->path,
            'server'     => json_encode($request->server()),
            'ip_address' => $request->ip(),
        ]);

        $this->addRelationRoute($row, $request);

        return $row;
    }

    protected function addRelationRoute($row, $request)
    {
        return $row->route()->create([
            'route_id' => $request->router->id,
            'event'    => $request->router->current['code'],
        ]);
    }

    public function cachePaginate($name)
    {
        return Cache::rememberForever('log-'.str_slug($name), function() {
            return $this->paginate();
        });
    }
}