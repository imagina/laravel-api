<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateGammaOfficeExtraRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'gamma_office_id' => 'required|integer|exists:irentcar__gamma_office,id',
            'extra_id' => 'required|integer|exists:irentcar__extras,id',
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
            'gamma_office_id.required' => itrans('irentcar::gammaofficeextra.messages.gammaOfficeIdIsRequired'),
            'gamma_office_id.exists' => itrans('irentcar::gammaofficeextra.messages.gammaOfficeIdExists'),
            'extra_id.required' => itrans('irentcar::gammaofficeextra.messages.extraIdIsRequired'),
            'extra_id.exists' => itrans('irentcar::gammaofficeextra.messages.extraIdExists'),
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
