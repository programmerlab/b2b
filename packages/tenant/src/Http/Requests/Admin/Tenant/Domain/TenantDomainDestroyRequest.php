<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Tenant\Domain;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class TenantDomainDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:tenant_domain,id',
            'row_id' => 'required'
        ];
    }
}
