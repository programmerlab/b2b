<?php

namespace Ribrit\Tenant\Http\Requests\Site\Image;

use Ribrit\Mars\Http\Requests\Site\SiteRequest;

class ImageIndexRequest extends SiteRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'row' => 'numeric|exists:image,id',
        ];
    }
}
