<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Theme\Layout;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ThemeLayoutUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required',
            'copy'   => 'required',
            'layout' => 'required'
        ];
    }
}
