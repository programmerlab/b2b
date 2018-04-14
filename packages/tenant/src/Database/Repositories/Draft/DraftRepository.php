<?php

namespace Ribrit\Tenant\Database\Repositories\Draft;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Draft\DraftContract;
use Ribrit\Tenant\Database\Models\Draft\Draft;

class DraftRepository extends Repository implements DraftContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'text',
        'texts',
    ];

    public function __construct(Draft $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function add($request)
    {
        $row = parent::add($request);
        $this->addRelationText($row, $request->texts);

        return $row;
    }

    public function update($request)
    {
        $row = parent::update($request);
        $row->texts()->delete();

        $this->addRelationText($row, $request->texts);

        return $row;
    }
}