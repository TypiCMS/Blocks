<?php

namespace TypiCMS\Modules\Blocks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255|alpha_dash|unique:blocks,name,'.$this->id,
            'status.*' => 'boolean',
            'body.*' => 'nullable',
        ];
    }
}
