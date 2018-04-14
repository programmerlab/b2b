<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Status;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class StatusDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:status,id',
            'row_id' => 'required'
        ];
    }
}
