<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Theme;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;
use Ribrit\Tenant\Http\Requests\Admin\Theme\ThemeAddRequest as AddRequest;
use Ribrit\Tenant\Http\Requests\Admin\Theme\ThemeDestroyRequest as DestroyRequest;
use Ribrit\Tenant\Http\Requests\Admin\Theme\ThemeUpdateRequest as UpdateRequest;

class ThemeController extends AdminController
{
	public function __construct(ThemeContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;

		$this->setRouterMethod();

		$this->jsonFormData = [
			'trigger' => [
				'#modalUrl .close'
			]
		];
	}

	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->groupPaginate($this->appGroup->id)
		]);
	}

	public function getCreate()
	{
		return $this->layout([
			'rows' => $this->contract->getGroupThemes($this->appGroup->code)
		]);
	}

	public function getEdit($group, $id)
	{
		if (!$row = $this->contract->row($id)) {
			return error(404);
		}

		$this->metaData = [
			'title' => ucfirst($row['name'])
		];

		return $this->layout([
			'sites'       => array_el_to_key($row->sites, 'site_id'),
			'dataLogo'    => $this->getImageLayout('accessory[logo]', $row->logo),
			'dataFavIcon' => $this->getImageLayout('accessory[favicon]', $row->favicon),
			'dataLogin'   => $this->getImageLayout('accessory[login_logo]', $row->login_logo),
			'config'      => $this->contract->groupTheme($group, $row->name),
			'row'         => $row
		]);
	}

	public function postAdd(AddRequest $request)
	{
		$row = $this->contract->add($request);

		return $this->crudMessage($request, ['id' => $row->id]);
	}

	public function postUpdate(UpdateRequest $request)
	{
		$this->contract->update($request);

		$this->createFormData([
			'success'  => $this->statusLangMessage('update'),
			'redirect' => [
				'url'     => $this->appRouter->methods['edit']['url'] . '/' . $request->id,
				'message' => $this->statusLangMessage('update')
			]
		]);

		return $this->responseFormData(200);
	}

	public function postDestroy(DestroyRequest $request)
	{
		$this->contract->destroy($request);

		return $this->crudMessage($request);
	}

	protected function setRouterMethod()
	{
		Request::setRouterMethod([
			'create' => [
				'modal' => route_modal_url($this->appRouter->methods['create']['url'])
			]
		]);
	}
}