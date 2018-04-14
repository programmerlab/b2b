<?php

namespace Ribrit\Tenant\Database\Repositories\Definition;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Repositories\Definition\DefinitionRepository as Repository;
use Ribrit\Tenant\Database\Contracts\Definition\DefinitionContract;
use Ribrit\Tenant\Database\Models\Definition\TenantDefinition;

class DefinitionRepository extends Repository implements DefinitionContract
{
	public function __construct(TenantDefinition $model)
	{
		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function cacheGroups()
	{
		return Cache::rememberForever(cache_name('tenant_definitions-' . lang('id')), function () {
			return $this->groups();
		});
	}

	public function forget($request)
	{
		foreach (config('langs') as $lang) {
			Cache::forget(cache_name('tenant_definitions-' . $lang['id']));
		}
	}

	public function mikro($groupId, $langId, $results)
	{
		foreach ($results as $data) {
			$item = $this->model->whereHas('accessories', function ($query) use ($data) {
				$query->where('key', 'tslt_RECno');
				$query->where('value', $data['tslt_RECno']);
			})->first();

			if ($item) {
				$this->mikroUpdate($item, $data);
			} else {
				$this->mikroStore($groupId, $langId, $data);
			}
		}
	}

	public function mikroStore($groupId, $langId, $data)
	{
		$item = $this->model->create([
			'group_id'  => $groupId,
			'row'       => 100,
			'active'    => 'yes',
		]);

		$item->texts()->create([
			'lang_id' => $langId,
			'title'   => mikro_string($data['tslt_ismi'])
		]);

		$item->accessories()->create([
			'key'   => 'tslt_RECno',
			'value' => $data['tslt_RECno']
		]);
	}

	public function mikroUpdate($item, $data)
	{
		$item->texts()->update([
			'title' => mikro_string($data['tslt_ismi'])
		]);
	}
}