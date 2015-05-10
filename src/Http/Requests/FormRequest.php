<?php
namespace TypiCMS\Modules\Blocks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules()
    {
        $rules = [
            'name' => 'required|alpha_dash|unique:blocks,name,' . $this->id,
        ];
        return $rules;
    }
}
