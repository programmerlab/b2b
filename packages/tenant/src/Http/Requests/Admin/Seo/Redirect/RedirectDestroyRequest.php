<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Seo\Redirect;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class RedirectDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:rewrite,id',
            'row_id' => 'required'
        ];
    }
}
