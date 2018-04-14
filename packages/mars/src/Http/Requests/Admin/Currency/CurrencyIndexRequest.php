<?php

namespace Ribrit\Mars\Http\Requests\Admin\Currency;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class CurrencyIndexRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency' => 'numeric|exists:currency,id',
        ];
    }
}