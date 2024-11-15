<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use App\Models\Api\AddressInterface;
use App\Models\Order;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAddressRequest $request)
    {
        $requestData = $request->safe()->all();
        $order = Order::find((int)$requestData['address_order_id']);
        $shippingAddress = $this->createAddress(
            $requestData,
            AddressInterface::TYPE_SHIPPING
        );

        $shippingIsBilling = (bool) ($requestData['shipping_is_billing'] ?? false);
        if ($shippingIsBilling) {
            $billingAddress = clone $shippingAddress;
            $billingAddress->setType(AddressInterface::TYPE_BILLING);
        } else {
            $billingAddress = $this->createAddress(
                $requestData,
                AddressInterface::TYPE_BILLING
            );
        }

        $order->addresses()->saveMany([
            $shippingAddress,
            $billingAddress
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
    }

    /**
     * @param array $requestData
     * @param string $type
     *
     * @return Address
     */
    private function createAddress(array $requestData, string $type): Address
    {
        $address = new Address();
        $address->setType($type);
        $address->setName($requestData["{$type}_name"]);
        $address->setEmail($requestData["{$type}_email"]);
        $address->setPhone($requestData["{$type}_phone"]);
        $address->setCountry($requestData["{$type}_country"]);
        $address->setCity($requestData["{$type}_city"]);
        $address->setStreet($requestData["{$type}_street"]);
        $address->setHouseNumber($requestData["{$type}_house_number"]);
        $address->setZipcode($requestData["{$type}_zipcode"]);
        $address->setAddressLine2($requestData["{$type}_address_line_2"] ?? '');
        $address->setCompanyName($requestData["{$type}_company_name"] ?? '');

        return $address;
    }
}
