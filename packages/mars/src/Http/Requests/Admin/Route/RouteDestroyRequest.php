<?php

namespace Ribrit\Mars\Http\Requests\Admin\Route;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class RouteDestroyRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|exists:route,id',
            'row_id' => 'required'
        ];
    }
}
