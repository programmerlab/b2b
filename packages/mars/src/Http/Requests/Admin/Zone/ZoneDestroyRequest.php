<?php

namespace Ribrit\Mars\Http\Requests\Admin\Zone;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ZoneDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:zone,id',
            'row_id' => 'required'
        ];
    }
}
