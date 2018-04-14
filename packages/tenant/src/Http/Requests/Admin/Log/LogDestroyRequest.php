<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Log;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LogDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:log,id',
            'row_id' => 'required'
        ];
    }
}
