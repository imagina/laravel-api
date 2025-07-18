<?php

namespace Modules\Islider\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateSliderRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required'
        ];
    }

    public function translationRules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'title.required' => itrans('islider::sliders.validation.nameIsRequired'),
        ];
    }

    public function translationMessages(): array
    {
        return [];
    }

    public function getValidator(): Validator
    {
        return $this->getValidatorInstance();
    }
}
