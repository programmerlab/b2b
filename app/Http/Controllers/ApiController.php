<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ApiIndexRequest;
use App\Services\MikroService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;

class ApiController extends Controller
{
    protected $tenant;

    public function __construct()
    {
        $this->tenant = $this->getTenant();

        config()->set('tenant', $this->tenant);

        ini_set('max_execution_time', 0);
    }

    public function getIndex($type, $tenantId, $secretCode, $method)
    {

    }

    public function postIndex(ApiIndexRequest $request, $type, $tenantId, $secretCode, $method)
    {
        $file = $request->file('data');
        $name = $file->getClientOriginalName();
        $path = base_path('storage/app');

        $file->move($path, $name);

        if ($request->full) {
            die ('Lütfen panelden entegrasyonu tamamlayın!');
        }

        (new MikroService())->handle(json_decode(File::get($path . '/' . $name)));

        //(new MikroService())->handle(json_decode(File::get(base_path('storage/app/2-2018-03-05-21-19-00.json'))));

        File::delete($path . '/' . $name);

        echo 'Success!';

        //return response()->json(json_decode(File::get($path . '/' . $name)), 200);
    }

    protected function getTenant()
    {
        $tenant = app(TenantContract::class)->findRestCode(request()->segment(3), request()->segment(4));

        if (!$tenant) {
            abort(404);
        }

        return $tenant;
    }
}
