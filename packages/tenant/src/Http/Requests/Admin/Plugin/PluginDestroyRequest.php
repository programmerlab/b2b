<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Plugin;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class PluginDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:plugin,id',
            'row_id' => 'required'
        ];
    }
}