<?php

namespace Modules\Inotification\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateNotificationTypeRequest extends CoreFormRequest
{
    public function rules(): array
        {
            return [];
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
            return [];
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
