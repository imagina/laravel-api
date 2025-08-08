<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateExtraRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|min:5|max:3000',
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
            'title.required' => itrans('irentcar::common.messages.titleIsRequired'),
            'title.min' => itrans('irentcar::common.messages.titleMin'),
            'description.min' => itrans('irentcar::common.messages.descriptionMin'),
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
