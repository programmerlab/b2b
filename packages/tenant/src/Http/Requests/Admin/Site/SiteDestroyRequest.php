<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Site;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class SiteDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:site,id',
            'row_id' => 'required'
        ];
    }
}
