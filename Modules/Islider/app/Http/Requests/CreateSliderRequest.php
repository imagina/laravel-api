<?php

namespace Modules\Islider\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateSliderRequest extends CoreFormRequest
{
    public function rules(): array
        {
            return [
                'name' => 'required'
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
                'name.required' => itrans('islider::sliders.validation.nameIsRequired'),
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
