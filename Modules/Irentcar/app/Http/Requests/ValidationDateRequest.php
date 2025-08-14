<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class ValidationDateRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'pickup_office_id' => 'required|integer|exists:irentcar__offices,id',
            'pickup_date' => ['required', 'date_format:Y-m-d'],
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
            'pickup_office_id.required' => itrans('irentcar::reservation.messages.pickupOfficeIdIsRequired'),
            'pickup_office_id.exists' => itrans('irentcar::reservation.messages.pickupOfficeIdExists'),
            'pickup_date.required' => itrans('irentcar::reservation.messages.pickupDateIsRequired'),
            'pickup_date.date_format' => itrans('irentcar::reservation.messages.pickupDateFormat'),
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
