<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DPDCalculatePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'arrival_city_id'     => ['required', 'exists:cities,city_id'],
            'derival_city_id'     => ['required', 'exists:cities,city_id'],
            'arrival_terminal'    => ['required', 'boolean'],
            'derival_terminal'    => ['required', 'boolean'],
            'parcel_total_weight' => ['required', 'numeric', 'min:0.01'],
            'parcel_total_volume' => ['sometimes', 'required', 'numeric', 'min:0.01'],
            'parcel_total_value'  => ['sometimes', 'required', 'numeric', 'min:0.01'],
            'services'            => ['sometimes', 'required', 'array'],
            'services.*'          => ['sometimes', 'required', 'string'],
            'pickup_date'         => ['sometimes', 'required', 'string'],
            'max_delivery_days'   => ['sometimes', 'required', 'string'],
            'max_delivery_price'  => ['sometimes', 'required', 'string']
        ];
    }
}
