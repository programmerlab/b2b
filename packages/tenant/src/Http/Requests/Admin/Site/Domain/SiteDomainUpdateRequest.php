<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Site\Domain;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class SiteDomainUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_id' => 'required|numeric|exists:site,id',
            'url'     => 'required|url|unique:site_domain,url,' . $this->get('id') . ',id',
        ];
    }
}
