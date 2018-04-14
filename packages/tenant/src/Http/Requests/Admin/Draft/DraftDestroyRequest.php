<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Draft;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class DraftDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:draft,id',
            'row_id' => 'required'
        ];
    }
}
