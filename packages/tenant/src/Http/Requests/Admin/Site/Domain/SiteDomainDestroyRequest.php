<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Site\Domain;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class SiteDomainDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:site_domain,id',
            'row_id' => 'required'
        ];
    }
}
