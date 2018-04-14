<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class TenantDomainUpdateRequest extends AdminRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'tenant_id' => 'required|numeric|exists:tenant,id',
			'url'       => 'required|url|unique:tenant_domain,url,' . $this->get('id') . ',id',
		];
	}
}
