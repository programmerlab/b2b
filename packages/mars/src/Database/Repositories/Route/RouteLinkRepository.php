<?php

namespace Ribrit\Mars\Database\Repositories\Route;

use Ribrit\Mars\Database\Contracts\Route\RouteLinkContract;
use Ribrit\Mars\Database\Models\Route\RouteLink;
use Ribrit\Mars\Database\Repositories\Repository;

class RouteLinkRepository extends Repository implements RouteLinkContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'text',
        'texts',
        'method',
        'method.text',
        'route',
        'route.text'
    ];

    public function __construct(RouteLink $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function inUrl($urls)
    {
        return $this->model
            ->whereHas('text', function($query) use($urls) {
                $query->whereIn('url', $urls);
            })
            ->with($this->with)
            ->get();
    }
}