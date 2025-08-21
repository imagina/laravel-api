<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateGammaOfficeRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'office_id' => 'required|integer|exists:irentcar__offices,id',
            'gamma_id' => 'required|integer|exists:irentcar__gammas,id',
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
            'office_id.required' => itrans('irentcar::gammaoffice.messages.officeIdIsRequired'),
            'office_id.exists' => itrans('irentcar::gammaoffice.messages.officeIdExists'),
            'gamma_id.required' => itrans('irentcar::gammaoffice.messages.gammaIdIsRequired'),
            'gamma_id.exists' => itrans('irentcar::gammaoffice.messages.gammaIdExists'),
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
