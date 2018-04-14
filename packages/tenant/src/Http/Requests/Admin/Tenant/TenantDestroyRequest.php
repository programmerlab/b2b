<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Tenant;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class TenantDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:tenant,id',
            'row_id' => 'required'
        ];
    }
}
