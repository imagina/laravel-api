<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

use Modules\Irentcar\Models\TransmissionType;
use Modules\Irentcar\Models\FuelType;
use Modules\Irentcar\Models\VehicleType;

class CreateGammaRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:3000',
            'passengers_number' => 'required|integer|min:1',
            'luggages' => 'required|integer|min:0',
            'doors' => 'required|integer|min:1',
            'next_gamma_id' => 'nullable|integer|exists:irentcar__gammas,id',
            'options' => 'nullable|json',
            'transmission_type' => 'nullable|integer|in:' . implode(',', array_keys((new TransmissionType())->lists())),
            'fuel_type' => 'nullable|integer|in:' . implode(',', array_keys((new FuelType())->lists())),
            'vehicle_type' => 'nullable|integer|in:' . implode(',', array_keys((new VehicleType())->lists())),
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
            'description.required' => itrans('irentcar::common.messages.descriptionIsRequired'),
            'description.min' => itrans('irentcar::common.messages.descriptionMin'),
            'passengers_number.required' => itrans('irentcar::gamma.messages.passengersNumberIsRequired'),
            'passengers_number.min' => itrans('irentcar::gamma.messages.passengersNumberMin'),
            'luggages.required' => itrans('irentcar::gamma.messages.luggagesIsRequired'),
            'doors.required' => itrans('irentcar::gamma.messages.doorsIsRequired'),
            'doors.min' => itrans('irentcar::gamma.messages.doorsMin'),
            'transmission_type.in' => itrans('irentcar::gamma.messages.transmissionTypeIn'),
            'fuel_type.in' => itrans('irentcar::gamma.messages.fuelTypeIn'),
            'vehicle_type.in' => itrans('irentcar::gamma.messages.vehicleTypeIn'),
            'next_gamma_id.exists' => itrans('irentcar::gamma.messages.nextGamaExist'),
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
