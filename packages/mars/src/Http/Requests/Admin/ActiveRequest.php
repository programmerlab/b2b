<?php

namespace Ribrit\Mars\Http\Requests\Admin;

class ActiveRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric'
        ];
    }
}
