<?php

namespace Ribrit\Tenant\Database\Models\Component;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;

class Theme extends Model
{
	use AccessoryRelationTrait, GroupRelationTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'theme';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'group_id',
		'group_code',
		'name',
		'description',
		'author',
		'link',
		'preview',
		'directory',
		'assets',
		'active'
	];

	/**
	 * Gruplara bağlı olarak temaların bulunduğu dizinler
	 *
	 * @var array
	 */
	public $locations = [
		'admin' => 'resources/themes/',
		'site'  => 'themes/',
	];
}