<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Note;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Note\NoteContract;
use Ribrit\Tenant\Http\Requests\Admin\Note\NoteAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Note\NoteDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Note\NoteIndexRequest as IndexRequest;
use Ribrit\Tenant\Http\Requests\Admin\Note\NoteUpdateRequest as UpdateRequest;

class NoteController extends AdminController
{
    public function __construct(NoteContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request)
    {
        if ($request->group) {
            $request->offsetSet('group_id', config('groups.note.' . $request->group . '.id'));
        }

        if ($request->ajax()) {
            $this->layoutCode = 'ajax.' . $this->appRouter->current['code'];
            $this->setRouterMethod($request);
        } else {
            $request->offsetUnset('path');
        }

        if (!$this->layoutCode) {
            Request::unSetRouterMethod('create');
        }

        return $this->layout([
            'rows' => $this->contract->requestPaginate($request)
        ]);
    }

    public function getCreate(IndexRequest $request)
    {
        if ($request->ajax()) {
            $this->layoutCode = 'ajax.' . $this->appRouter->current['code'];
            $this->setRouterMethod($request);
        } else {
            return error(404);
        }

        return $this->layout([
            //
        ]);
    }

    public function getEdit($id, IndexRequest $request)
    {
        if ($request->ajax()) {
            $this->layoutCode = 'ajax.' . $this->appRouter->current['code'];
            $this->setRouterMethod($request);
        }

        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'row' => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $request->offsetSet('user_id', $this->user->id);
        $request->offsetSet('author', $this->user->name);

        $this->contract->add($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('add'),
            'trigger' => [
                '#buttonNoteGetIndex'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        $this->createFormData([
            'success' => $this->statusLangMessage('update'),
            'trigger' => [
                '#buttonNoteGetIndex'
            ]
        ]);

        return $this->responseFormData(200);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    protected function setRouterMethod($request)
    {
        $query = '?parent=' . $request->parent . '&group=' . $request->group . '&path=' . $request->path . '&path_title=' . urlencode($request->path_title);

        Request::setRouterMethod([
            'create' => [
                'modal' => route_modal_url($this->appRouter->methods['create']['url'] . $query)
            ],
            'edit'   => [
                'modal' => route_modal_url($this->appRouter->methods['edit']['url'] . '/{id}' . $query)
            ],
        ]);
    }
}