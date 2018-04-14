<?php

namespace Ribrit\Tenant\Database\Repositories\Tenant;

use Illuminate\Support\Facades\Cache;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Database\Models\Tenant\Tenant;

class TenantRepository extends Repository implements TenantContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'accessories',
		'domain',
		'domains',
	];

	public function __construct(Tenant $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function whereNotRows($ids)
	{
		return $this->model->whereNotIn('id', $ids)->with($this->with)->get();
	}

	public function update($request)
	{
		$row = parent::update($request);

		$this->forgetCache($row, $request);

		return $row;
	}

	public function rowCache($id)
	{
		return Cache::rememberForever('tenant-' . $id, function () use ($id) {
			return $this->row($id);
		});
	}

	public function domainRowCache($url)
	{
		return Cache::rememberForever(str_slug($url), function () use ($url) {
			$this->with['domain'] = function ($query) use ($url) {
				$query->whereUrl($url);
			};

			return $this->model->whereHas('domain', function ($query) use ($url) {
				$query->whereUrl($url);
			})->with($this->with)->first();
		});
	}

	public function domainSiteRowCache($url)
	{
		return Cache::rememberForever(str_slug($url), function () use ($url) {
			$this->with['domain'] = function ($query) use ($url) {
				$query->whereUrl($url);
			};

			return $this->model->whereHas('domain', function ($query) use ($url) {
				$query->whereUrl($url);
			})->with($this->with)->first();


		});
	}

	public function updateAccessories($request)
	{
		$row = $this->model->findOrFail($request->id);

		$this->accessoryUpdateOrStore($row, $request->accessory);

		$this->forgetCache($row, $request);

		return $row;
	}

	protected function domainSiteRow($url)
	{
		$this->with['site'] = function ($query) use ($url) {
			$query->whereHas('domain', function ($query) use ($url) {
				$query->whereUrl($url);
			});
		};

		$row = $this->model->whereHas('site.domain', function ($query) use ($url) {
			$query->whereUrl($url);
		})->with($this->with)->first();

		return $row;
	}

	protected function forgetCache($tenant, $request)
	{
		Cache::forget('tenant-' . $tenant->id);

		foreach ($tenant->sites as $site) {
			foreach ($site->domains as $domain) {
				Cache::forget(str_slug($domain->url));
			}
		}

		foreach ($tenant->domains as $domain) {
			Cache::forget(str_slug($domain->url));
		}
	}

	public function findRestCode($tenantId, $secretCode)
	{
		return $this->model->with($this->with)->where('private_key', $secretCode)->find($tenantId);
	}
}