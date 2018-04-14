<?php

namespace Ribrit\Mars\Http\Requests\Admin\Layout;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LayoutDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:layout,id',
            'row_id' => 'required'
        ];
    }
}
