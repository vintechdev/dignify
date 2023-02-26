<?php

namespace TypiCMS\Modules\Products\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class BrochuresFormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'product_category_id' => 'required|integer',
            'tag_id'=>'required|integer',
            'url'=>'nullable|url'
        ];
    }
}
