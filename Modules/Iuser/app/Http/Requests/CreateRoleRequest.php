<?php

namespace Modules\Iuser\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateRoleRequest extends CoreFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:iuser__roles,slug'
        ];
    }

    public function translationRules(): array
    {
        return [
            'title' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
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
