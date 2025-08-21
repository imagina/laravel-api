<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateReservationRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'pickup_date' => ['required', 'date_format:Y-m-d H:i'],
            'dropoff_date' => ['required', 'date_format:Y-m-d H:i'],
            'pickup_office_id' => 'required|integer|exists:irentcar__offices,id',
            'dropoff_office_id' => 'required|integer|exists:irentcar__offices,id',
            //'gamma_id' => 'required|integer|exists:irentcar__gammas,id',
            'gamma_office_id' => 'required|integer|exists:irentcar__gamma_office,id',
            'gamma_office_extra_ids' => 'nullable|json',
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
            'pickup_date.required' => itrans('irentcar::reservation.messages.pickupDateIsRequired'),
            'pickup_date.date_format' => itrans('irentcar::reservation.messages.pickupDateFormat'),
            'dropoff_date.required' => itrans('irentcar::reservation.messages.dropoffDateIsRequired'),
            'dropoff_date.date_format' => itrans('irentcar::reservation.messages.dropoffDateFormat'),
            'pickup_office_id.required' => itrans('irentcar::reservation.messages.pickupOfficeIdIsRequired'),
            'pickup_office_id.exists' => itrans('irentcar::reservation.messages.pickupOfficeIdExists'),
            'dropoff_office_id.required' => itrans('irentcar::reservation.messages.dropoffOfficeIdIsRequired'),
            'dropoff_office_id.exists' => itrans('irentcar::reservation.messages.dropoffOfficeIdExists'),
            'gamma_id.required' => itrans('irentcar::reservation.messages.gammaIdIsRequired'),
            'gamma_id.exists' => itrans('irentcar::reservation.messages.gammaIdExists'),
            'gamma_office_id.required' => itrans('irentcar::reservation.messages.gammaOfficeIdIsRequired'),
            'gamma_office_id.exists' => itrans('irentcar::reservation.messages.gammaOfficeIdExists'),
            'gamma_office_extra_ids.json' => itrans('irentcar::reservation.messages.gammaOfficeExtraIdsMustBeJson'),
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
