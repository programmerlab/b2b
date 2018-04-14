<?php

namespace Ribrit\Tenant\Http\Requests\Admin\Theme;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class ThemeDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $settingRules = [
            setting('theme.admin'),
            setting('theme.site')
        ];

        return [
            'id'     => 'required|exists:theme,id|not_in:' . join(',', $settingRules),
            'row_id' => 'required'
        ];
    }
}