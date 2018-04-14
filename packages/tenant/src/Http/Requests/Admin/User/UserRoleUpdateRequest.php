<?php

namespace Ribrit\Tenant\Http\Requests\Admin\User;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserRoleUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'       => 'required|numeric|exists:user,id',
            'name'     => 'required|max:95',
            'email'    => 'required|max:95|email|unique:user,email,' . $this->get('id') . ',id',
            'password' => 'min:6|max:30'
        ];
    }
}
