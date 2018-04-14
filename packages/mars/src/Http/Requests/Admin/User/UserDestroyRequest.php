<?php

namespace Ribrit\Mars\Http\Requests\Admin\User;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserDestroyRequest extends AdminRequest
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
