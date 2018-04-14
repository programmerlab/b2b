<?php

namespace Ribrit\Mars\Http\Requests\Admin\Group;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class GroupDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:group,id',
            'row_id' => 'required'
        ];
    }
}
