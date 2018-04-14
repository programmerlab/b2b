<?php

namespace Ribrit\Mars\Http\Controllers\Admin;

use Ribrit\Mars\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

abstract class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function statusLangMessage($key, $status = 'success')
    {
        return Lang::get('admin::admin.'.$status.'.'.$key);
    }

    public function crudMessage($request, array $data = [])
    {
        $this->{'create'.ucfirst($this->appRouter->current['code']).'ResponseMessage'}($request, $data);

        return $this->responseFormData(200);
    }

    public function createAddResponseMessage($request, $data)
    {
        $this->createFormData([
            'redirect' => [
                'url'     => $this->appRouter->methods['edit']['url'].'/'.$data['id'],
                'message' => $this->statusLangMessage('add')
            ]
        ]);
    }

    public function createUpdateResponseMessage($request, $data)
    {
        $this->createFormData([
            'success' => $this->statusLangMessage('update')
        ]);
    }

    public function createActiveResponseMessage($request)
    {
        $this->createFormData([
            'success' => $this->statusLangMessage('active')
        ]);
    }

    public function createPassiveResponseMessage($request)
    {
        $this->createFormData([
            'success' => $this->statusLangMessage('passive')
        ]);
    }

    public function createDestroyResponseMessage($request)
    {
        $removeData = [];

        foreach (explode(',', $request->id) as $id) $removeData[ $id ] = $request->row_id . $id;

        $this->createFormData([
            'success' => $this->statusLangMessage('destroy'),
            'remove'  => $removeData
        ]);
    }

    public function createRowResponseMessage($request)
    {
        $this->createFormData([
            'success' => $this->statusLangMessage('row')
        ]);
    }

    public function createImportResponseMessage($request)
    {
        $this->createFormData([
            'redirect' => [
                'url'     => $this->appRouter->methods['index']['url'],
                'message' => $this->statusLangMessage('import')
            ]
        ]);
    }

    public function getImageLayout($name, $value = null, $id = null)
    {
        return [
            'id'    => $id ? $id : str_slug($name),
            'name'  => $name,
            'value' => $value
        ];
    }
}
