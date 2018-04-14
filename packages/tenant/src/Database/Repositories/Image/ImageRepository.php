<?php

namespace Ribrit\Tenant\Database\Repositories\Image;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Image\ImageContract;
use Ribrit\Tenant\Database\Models\Image\Image;

class ImageRepository extends Repository implements ImageContract
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

    public function __construct(Image $model)
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

                if ($request->group_id) {
                    $query->where('group_id', $request->group_id);
                }

                if ($request->parent) {
                    $query->where('process_id', $request->parent);
                }
            })
            ->orderBy('row', 'asc')
            ->paginate($this->perPage);
    }

    public function processRows($groupCode, $processId)
    {
        return $this->model
            ->with($this->with)
            ->where('group_id', config('groups.image.' . $groupCode . '.id'))
            ->where('process_id', $processId)
            ->orderBy('row', 'asc')
            ->get();
    }

    public function multilepeAdd($request)
    {
        $images = $request->images;

        foreach ((array)$images as $image) {

            $request->offsetSet('src', $image['src']);
            $request->offsetSet('texts', $image['texts']);

            $this->add($request);
        }
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