<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

class ValidationGammasToReservationRequest extends CoreFormRequest
{
    /* public function prepareForValidation(): void
    {
        if (!$this->has('dropoff_office_id')) {
            $this->merge([
                'dropoff_office_id' => $this->input('pickup_office_id'),
            ]);
        }
    } */

    public function rules(): array
    {
        return [
            'pickup_office_id' => 'required|integer|exists:irentcar__offices,id',
            'pickup_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'dropoff_office_id' => 'required|integer|exists:irentcar__offices,id',
            'dropoff_date' => ['required', 'date_format:Y-m-d H:i:s'],
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
            'dropoff_office_id.required' => itrans('irentcar::reservation.messages.dropoffOfficeIdIsRequired'),
            'dropoff_office_id.exists' => itrans('irentcar::reservation.messages.dropoffOfficeIdExists'),
            'dropoff_date.required' => itrans('irentcar::reservation.messages.dropoffDateIsRequired'),
            'dropoff_date.date_format' => itrans('irentcar::reservation.messages.dropoffDateFormat'),
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
