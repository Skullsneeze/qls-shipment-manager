<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_number' => 'required|unique:orders,number|max:255',
            'products' => 'list',
            'products.*' => 'array:name,price,qty,sku,ean',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|max:255',
            'products.*.qty' => 'required|numeric|min:1,max:255',
            'products.*.sku' => 'required|max:255',
            'products.*.ean' => 'required|numeric|max_digits:128',
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
