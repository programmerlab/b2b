<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Theme\Container;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ThemeContainerRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'layout' => 'required|numeric'
        ];
    }
}