<?php

namespace Ribrit\Mars\Database\Repositories\User;

use Illuminate\Support\Facades\Hash;
use Ribrit\Mars\Database\Contracts\User\UserContract;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Mars\Database\Repositories\Repository;

class UserRepository extends Repository implements UserContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'accessories',
		'role',
		'role.role',
		'role.role.text',
		'roles',
		'roles.role',
		'roles.role.text',
	];

	public function __construct(User $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function searchRows($request)
	{
		return $this->model->fillable([
			'id',
			'name',
			'email'
		])->where('name', 'like', '%' . $request->q . '%')->limit($this->perPage)->select('id', 'name as title',
			'email as description', 'name', 'email')->get()->toArray();
	}

	public function searchCodeRows($request)
	{
		return $this->model->fillable([
			'id',
			'name',
			'email'
		])->where('code', 'like', '%' . $request->q . '%')->limit($this->perPage)->select('id', 'name as title',
			'email as description', 'name', 'email')->get()->toArray();
	}

	public function nameRoleFirst($name, $role)
	{
		return $this->model->whereName($name)->whereHas('roles.role', function ($query) use ($role) {
			$query->whereCode($role);
		})->first();
	}

	public function add($request)
	{
		$row = parent::add($request);
		$this->addRelationAccessory($row, $request->accessory);
		$this->addRelationMainRole($row, $request->main_role);
		$this->addRelationSite($row, $request->site_id);

		return $row;
	}

	public function addRelationMainRole($row, $roleId)
	{
		$row->roles()->delete();

		return $row->role()->create([
			'role_id' => $roleId,
			'main'    => 'yes'
		]);
	}

	public function addRelationSite($row, $siteId)
	{
		if (!$siteId) {
			return $row;
		}

		$row->site()->delete();

		return $row->site()->create([
			'site_id' => $siteId,
		]);
	}

	public function update($request)
	{
		$row = parent::update($request);
		$row->accessories()->delete();

		$this->addRelationAccessory($row, $request->accessory);
		$this->addRelationMainRole($row, $request->main_role);
		$this->addRelationSite($row, $request->site_id);

		return $row;
	}

	public function email($email)
	{
		return $this->model->whereEmail($email)->first();
	}

	public function codePaginate($code)
	{
		return $this->model->whereHas('roles.role', function ($query) use ($code) {
			$query->whereCode($code);
		})->with($this->with)->orderBy('created_at', 'desc')->paginate($this->perPage);
	}

	public function codeGet($code)
	{
		return $this->model->whereHas('roles.role', function ($query) use ($code) {
			$query->whereCode($code);
		})->with($this->with)->orderBy('created_at', 'desc')->get();
	}

	public function validTenant($tenantId)
	{
		return $this->model->whereHas('tenants', function ($query) use ($tenantId) {
			$query->where('tenant_id', $tenantId);
		})->find($this->user->id);
	}

	public function userTwitter($request, $twitter)
	{
		if (!$user = $this->model->whereEmail(create_key_mail($twitter->id))->first()) {
			return $this->addUserTwitter($request, $twitter);
		}

		if (!$tenant = $user->tenants()->where('tenant_id', $request->tenant_id)->first()) {
			$user->tenants()->create([
				'tenant_id' => $request->tenant_id
			]);
		}

		return $user;
	}

	protected function addUserTwitter($request, $twitter)
	{
		$accessory = [
			'avatar'      => $twitter->avatar,
			'lang'        => setting('system.lang'),
			'currency'    => setting('system.currency'),
			'namesurname' => $twitter->name,
			'gender'      => null
		];

		if (!$twitter->email) {
			$twitter->email = create_key_mail($twitter->id);
		}

		$request->offsetSet('main_role', setting('user.user_role'));
		$request->offsetSet('email', $twitter->email);
		$request->offsetSet('name', $twitter->nickname);
		$request->offsetSet('password', Hash::make(str_random(9)));
		$request->offsetSet('active', 'yes');
		$request->offsetSet('accessory', $accessory);

		$user = $this->add($request);
		$user->tenants()->create([
			'tenant_id' => $request->tenant_id
		]);

		return $user;
	}

	public function userFacebook($request, $facebook)
	{
		if (!$user = $this->model->whereEmail($facebook->email)->first()) {
			return $this->addUserFacebook($request, $facebook);
		}

		if (!$tenant = $user->tenants()->where('tenant_id', $request->tenant_id)->first()) {
			$user->tenants()->create([
				'tenant_id' => $request->tenant_id
			]);
		}

		return $user;
	}

	protected function addUserFacebook($request, $facebook)
	{
		$accessory = [
			'avatar'      => $facebook->avatar_original,
			'lang'        => setting('system.lang'),
			'currency'    => setting('system.currency'),
			'namesurname' => $facebook->name,
			'gender'      => $facebook->user['gender']
		];

		$request->offsetSet('main_role', setting('user.user_role'));
		$request->offsetSet('email', $facebook->email);
		$request->offsetSet('name', $facebook->nickname ? $facebook->nickname : $facebook->id);
		$request->offsetSet('password', Hash::make(str_random(9)));
		$request->offsetSet('active', 'yes');
		$request->offsetSet('accessory', $accessory);

		$user = $this->add($request);
		$user->tenants()->create([
			'tenant_id' => $request->tenant_id
		]);

		return $user;
	}
}