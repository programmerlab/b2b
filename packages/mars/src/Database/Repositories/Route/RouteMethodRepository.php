<?php

namespace Ribrit\Mars\Database\Repositories\Route;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Contracts\Route\RouteMethodContract;
use Ribrit\Mars\Database\Models\Route\RouteMethod;
use Ribrit\Mars\Database\Repositories\Repository;

class RouteMethodRepository extends Repository implements RouteMethodContract
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

    public function __construct(RouteMethod $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function cacheName()
    {
        return Cache::rememberForever('routeMethods-'.lang('id'), function() {
            return $this->name();
        });
    }

    protected function name()
    {
        $methods = [];

        foreach ($this->activeRows()as $row) {
            $methods[ $row->code ] = $this->method($row);
        }

        return $methods;
    }

    protected function method($row)
    {
        return [
            'id'       => $row['id'],
            'as'       => ucfirst($row->method) . ucfirst($row->code),
            'name'     => ucfirst($row->code),
            'method'   => $row->row,
            'code'     => $row->code,
            'url'      => '',
            'title'    => $row->text->title,
            'original' => $row->toArray(),
        ];
    }
}