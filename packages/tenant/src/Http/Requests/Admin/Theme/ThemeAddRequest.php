<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Theme;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ThemeAddRequest extends AdminRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required'
		];
	}
}