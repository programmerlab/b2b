<?php

namespace Ribrit\Mars\Http\Requests\Admin\Role;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class RoleDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:role,id',
            'row_id' => 'required'
        ];
    }
}
