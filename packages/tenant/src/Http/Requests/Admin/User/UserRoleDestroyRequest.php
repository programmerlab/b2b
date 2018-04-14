<?php

namespace Ribrit\Tenant\Http\Requests\Admin\User;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserRoleDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:user,id',
            'row_id' => 'required'
        ];
    }
}
