<?php

namespace Ribrit\Mars\Http\Requests\Admin;

use Illuminate\Support\Facades\Lang;
use Ribrit\Mars\Http\Requests\Request;

abstract class AdminRequest extends Request
{
    public function attributes()
    {
        return [
            'texts.*.title' => Lang::get('public.title')
        ];
    }
}
