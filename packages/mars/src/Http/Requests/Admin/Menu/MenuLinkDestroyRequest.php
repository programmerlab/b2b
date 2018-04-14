<?php

namespace Ribrit\Mars\Http\Requests\Admin\Menu;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class MenuLinkDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:menu_link,id',
            'row_id' => 'required'
        ];
    }
}
