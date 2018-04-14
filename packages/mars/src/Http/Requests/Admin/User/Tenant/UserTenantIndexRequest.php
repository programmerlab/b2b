<?php

namespace Ribrit\Mars\Http\Requests\Admin\User\Tenant;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class UserTenantIndexRequest extends AdminRequest
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
