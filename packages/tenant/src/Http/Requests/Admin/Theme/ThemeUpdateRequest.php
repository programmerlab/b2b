<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Theme;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ThemeUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->offsetSet('id', $this->get('theme_id'));
        $this->offsetUnset('path');

        return [
            //
        ];
    }
}
