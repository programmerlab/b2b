<?php

namespace Ribrit\Mars\Http\Requests\Admin\Currency;

use Ribrit\Mars\Http\Requests\Admin\AdminRequest;

class CurrencyUpdateRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'numeric|exists:currency,id',
        ];
    }
}
