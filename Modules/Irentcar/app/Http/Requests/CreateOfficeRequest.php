<?php

namespace Modules\Irentcar\Http\Requests;

use Imagina\Icore\Http\Request\CoreFormRequest;
use Illuminate\Contracts\Validation\Validator;

use Modules\Irentcar\Models\Status;

class CreateOfficeRequest extends CoreFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|min:5|max:3000',
            'status' => 'nullable|integer|in:' . implode(',', array_keys((new Status())->lists())),
            'locatable.country_id' => 'required',
            'locatable.province_id' => 'required',
            'locatable.city_id' => 'required',
            'locatable.address' => 'required',
            'locatable.lat' => 'required',
            'locatable.lng' => 'required',
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
            'status.in' => itrans('irentcar::common.messages.statusIn'),
            'locatable.country_id.required' => itrans('irentcar::office.messages.locatable.countryIdIsRequired'),
            'locatable.province_id.required' => itrans('irentcar::office.messages.locatable.provinceIdIsRequired'),
            'locatable.city_id.required' => itrans('irentcar::office.messages.locatable.cityIdIsRequired'),
            'locatable.address.required' => itrans('irentcar::office.messages.locatable.addressIdIsRequired'),
            'locatable.lat.required' => itrans('irentcar::office.messages.locatable.latIdIsRequired'),
            'locatable.lng.required' => itrans('irentcar::office.messages.locatable.lngIdIsRequired'),
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
