<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $countries = implode(',', array_keys(Shipment::getShippingCountries()));
        return [
            'address_order_id' => '',
            'shipping_company_name' => 'max:255',
            'shipping_name' => 'required|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|max:255',
            'shipping_country' => "required|in:$countries|max:255",
            'shipping_city' => 'required|max:255',
            'shipping_street' => 'required|max:255',
            'shipping_house_number' => 'required|max:255',
            'shipping_zipcode' => 'required|max:255',
            'shipping_address_line_2' => 'max:255',
            'shipping_is_billing' => '',
            'billing_company_name' => 'max:255',
            'billing_name' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_email' => 'required_if_declined:shipping_is_billing|email|max:255',
            'billing_phone' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_country' => "required_if_declined:shipping_is_billing|in:$countries|max:255",
            'billing_city' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_street' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_house-number' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_zipcode' => 'required_if_declined:shipping_is_billing|max:255',
            'billing_address_line_2' => 'max:255',
        ];
    }

    /**
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
