<?php

namespace Ribrit\Tenant\Http\Requests\Admin\User;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserRoleAddRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|max:95',
            'email'    => 'required|max:95|email|unique:user',
            'password' => 'required|min:6|max:30'
        ];
    }
}
