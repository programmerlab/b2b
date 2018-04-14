<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Tenant;

use App\Services\MikroService;
use Illuminate\Support\Facades\File;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\TenantAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\TenantDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\TenantImportRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\TenantUpdateRequest as UpdateRequest;

class TenantController extends AdminController
{
    public function __construct(TenantContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;

        ini_set('max_execution_time', 0);
    }

    public function getIndex()
    {
        return $this->layout([
            'rows' => $this->contract->paginate()
        ]);
    }

    public function getCreate()
    {
        return $this->layout();
    }

    public function getEdit($id)
    {
        if (!$row = $this->contract->row($id)) {
            return error(404);
        }

        return $this->layout([
            'row' => $row
        ]);
    }

    public function postAdd(AddRequest $request)
    {
        $request->offsetSet('private_key', generate_api_key());
        $request->offsetSet('public_key', generate_api_key());

        $row = $this->contract->add($request);

        return $this->crudMessage($request, ['id' => $row->id]);
    }

    public function postUpdate(UpdateRequest $request)
    {
        $this->contract->update($request);

        return $this->crudMessage($request);
    }

    public function postDestroy(DestroyRequest $request)
    {
        $this->contract->destroy($request);

        return $this->crudMessage($request);
    }

    public function postImport(TenantImportRequest $request)
    {
        config()->set('tenant', $this->contract->row($request->form_tenant_id));

        $name = $request->form_tenant_id . '-mikro.json';
        $path = base_path('storage/app');

        (new MikroService())->handle(json_decode(File::get($path . '/' . $name)));
    }
}