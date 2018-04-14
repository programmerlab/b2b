<?php

namespace Ribrit\Tenant\Database\Repositories\Note;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Note\NoteContract;
use Ribrit\Tenant\Database\Models\Note\Note;

class NoteRepository extends Repository implements NoteContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        'group',
        'user'
    ];

    public function __construct(Note $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function requestPaginate($request)
    {
        return $this->model
            ->with($this->with)
            ->orderBy('created_at', 'desc')
            ->where(function($query) use($request) {

                if ($request->group) {
                    $query->where('group_id', $request->group_id);
                }

                if ($request->path) {
                    $query->where('path', $request->path);
                }

                if ($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }
            })
            ->paginate($this->perPage);
    }
}