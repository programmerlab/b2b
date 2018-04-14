<?php

namespace Ribrit\Mars\Database\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Ribrit\Mars\Helpers\DateHelper;

abstract class Model extends BaseModel
{
	/**
	 * Actif row
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeActive($query)
	{
		return $query->where('active', 'yes');
	}

	/**
	 * Actif row
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopePublish($query)
	{
		$now = DateHelper::now();

		return $query->where('start_publish', '<=', $now)->where('finish_publish', '>=', $now);
	}

	/**
	 * Grup id
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeGroupid($query)
	{
		return $query->where('group_id', request('group_id'));
	}

	/**
	 * Geçerli site
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeHookSite($query)
	{
		return $query->where('site_id', tenant_site('id'));
	}

	/**
	 * Geçerli dil
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeHookLang($query)
	{
		return $query->where('lang_id', lang('id'));
	}
}
