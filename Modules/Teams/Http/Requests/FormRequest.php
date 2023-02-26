<?php

namespace TypiCMS\Modules\Teams\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d',
            //'website' => 'nullable|url|max:255',
            'image_id' => 'nullable|integer',
            'job_title.*' => 'nullable|max:255',
            'name'=> 'required|max:255',
            'body.*' => 'nullable',
        ];
    }
}
