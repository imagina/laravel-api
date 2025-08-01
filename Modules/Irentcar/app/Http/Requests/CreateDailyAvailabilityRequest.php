<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateDailyAvailabilityRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'gamma_office_id' => 'required|integer|exists:irentcar__gamma_office,id',
            'date' => [
                'required',
                'date_format:Y-m-d',
            ],
            'quantity' => 'nullable|integer',
            'reason' => 'nullable|string|max:3000',

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
            'gamma_office_id.required' => itrans('irentcar::dailyavailability.messages.gammaOfficeIdIsRequired'),
            'gamma_office_id.exists' => itrans('irentcar::dailyavailability.messages.gammaOfficeIdExists'),
            'date.required' => itrans('irentcar::dailyavailability.messages.dateIsRequired'),
            'date.date_format' => itrans('irentcar::dailyavailability.messages.dateFormat'),
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
