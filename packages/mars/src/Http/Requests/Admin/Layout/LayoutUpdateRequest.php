<?php

namespace Ribrit\Mars\Http\Requests\Admin\Layout;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LayoutUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:layout,code,' . $this->get('id') . ',id',
        ];
    }
}
