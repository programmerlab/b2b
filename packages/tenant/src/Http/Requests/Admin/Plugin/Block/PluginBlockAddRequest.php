<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Plugin\Block;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class PluginBlockAddRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}