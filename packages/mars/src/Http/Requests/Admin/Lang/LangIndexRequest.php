<?php

namespace Ribrit\Mars\Http\Requests\Admin\Lang;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class LangIndexRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lang' => 'numeric|exists:lang,id',
        ];
    }
}