<?php

namespace Ribrit\Mars\Http\Requests\Admin\User;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserAddRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_role' => 'required|numeric|exists:role,id',
            'name'      => 'required|max:95',
            'email'     => 'required|max:95|email|unique:user',
            'password'  => 'required|min:6|max:30'
        ];
    }
}
