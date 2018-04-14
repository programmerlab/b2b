<?php

namespace Ribrit\Mars\Http\Requests\Admin\Lang;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LangUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'               => 'required|numeric|exists:lang,id',
            'name'             => '',
            'iso_code'         => '',
            'language_code'    => '',
            'date_format_lite' => '',
            'date_format_full' => ''
        ];
    }
}
