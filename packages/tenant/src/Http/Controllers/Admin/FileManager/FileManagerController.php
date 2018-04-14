<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\FileManager;

use Illuminate\Support\Facades\File;
use Ribrit\Elfinder\ElfinderController;
use Illuminate\Support\Facades\Config;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class FileManagerController extends AdminController
{
	public function __construct()
	{
		parent::__construct();

		$this->contract = app(ElfinderController::class);

		$this->validDirectory();
	}

	public function getIndex()
	{
		return $this->layout([
			'filemanager' => $this->contract->showIndex()
		]);
	}

	public function getLayout()
	{
		Config::set('debugbar.enabled', false);

		return $this->contract->showIndex();
	}

	public function getRelated()
	{
		return $this->contract->showConnector();
	}

	public function postConnect()
	{
		return $this->contract->showConnector();
	}

	protected function validDirectory()
	{
		$path = 'storage/' . tenant('id');
		$publicPath = public_path($path);

		if (setting('user.root_role') != $this->user->role->role_id) {
			Config::set('elfinder.dir', [$path]);
		}

		if (!File::exists($publicPath)) {
			File::makeDirectory($publicPath);
		}
	}
}