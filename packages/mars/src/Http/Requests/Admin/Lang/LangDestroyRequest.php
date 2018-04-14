<?php

namespace Ribrit\Mars\Http\Requests\Admin\Lang;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LangDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:lang,id',
            'row_id' => 'required'
        ];
    }
}
