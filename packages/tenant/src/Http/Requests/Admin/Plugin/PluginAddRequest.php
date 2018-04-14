<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Plugin;

use Illuminate\Support\Facades\Lang;
use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class PluginAddRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:plugin,name'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique' => Lang::get('admin::admin/plugin/plugin.unique')
        ];
    }
}