<?php

namespace TypiCMS\Modules\Products\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class CategoryTypeFormRequest extends AbstractFormRequest
{
    public function rules()
    {
         return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'slug.*' => 'nullable|alpha_dash|max:255|required_if:status.*,1|required_with:title.*',
        ];
    }
}
