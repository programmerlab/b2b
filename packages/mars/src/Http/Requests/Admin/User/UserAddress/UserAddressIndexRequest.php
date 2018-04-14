<?php

namespace Ribrit\Mars\Http\Requests\Admin\User\UserAddress;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserAddressIndexRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|numeric|exists:user,id'
        ];
    }
}
