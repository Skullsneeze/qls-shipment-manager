<?php

namespace App\Models\Client\Request;

use App\Models\Api\AddressInterface;
use App\Models\Api\Client\Request\CreateShipmentInterface;
use App\Models\Client\QlsApi;
use App\Models\Order;
use Illuminate\Contracts\Support\Arrayable;

class CreateShipment implements CreateShipmentInterface, Arrayable
{
    /**
     * @param Order $order
     *
     * @return CreateShipment
     */
    public static function fromOrder(Order $order): CreateShipment
    {
        $request = new static();
        $request->setReference($order->getNumber());
        $request->setWeight(fake()->numberBetween('1', '2000'));
        $request->setCodAmount(0);
        $request->setPieceTotal(1);

        $address = $order->getShippingAddress();
        $receiverContact = [
            self::FIELD_RECEIVER_CONTACT_COMPANYNAME => $address->getCompanyName(),
            self::FIELD_RECEIVER_CONTACT_NAME => $address->getName(),
            self::FIELD_RECEIVER_CONTACT_STREET => $address->getStreet(),
            self::FIELD_RECEIVER_CONTACT_HOUSENUMBER => $address->getHousenumber(),
            self::FIELD_RECEIVER_CONTACT_POSTALCODE => $address->getZipcode(),
            self::FIELD_RECEIVER_CONTACT_LOCALITY => $address->getCity(),
            self::FIELD_RECEIVER_CONTACT_COUNTRY => $address->getCountry(),
            self::FIELD_RECEIVER_CONTACT_EMAIL => $address->getEmail(),
        ];

        $request->setReceiverContact($receiverContact);

        return $request;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        foreach (self::ARRAY_FIELDS as $field) {
            $camelCaseField = str_replace(' ', '',
                ucwords(
                    str_replace(
                        ['-', '_'],
                        ' ',
                        $field
                    )
                )
            );

            $getter = "get$camelCaseField";
            $data[$field] = $this->{$getter}();
        }

        return $data;
    }

    public function getBrandId(): string
    {
        return config('services.qls_api.brand_id');
    }

    public function getReference(): string
    {
        return $this->{self::FIELD_REFERENCE};
    }

    public function setReference(string $reference): void
    {
        $this->{self::FIELD_REFERENCE} = $reference;
    }

    public function getWeight(): float
    {
        return $this->{self::FIELD_WEIGHT};
    }

    public function setWeight(float $weight): void
    {
        $this->{self::FIELD_WEIGHT} = $weight;
    }

    public function getProductId(): int
    {
        return $this->{self::FIELD_PRODUCT_ID} ?? QlsApi::DEFAULT_SHIPMENT_METHOD_ID;
    }

    public function setProductId(int $productId): void
    {
        $this->{self::FIELD_PRODUCT_ID} = $productId;
    }

    public function getProductCombinationId(): int
    {
        return $this->{self::FIELD_PRODUCT_COMBINATION_ID} ?? QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_ID;
    }

    public function setProductCombinationId(int $productCombinationId): void
    {
        $this->{self::FIELD_PRODUCT_COMBINATION_ID} = $productCombinationId;
    }

    public function getCodAmount(): float
    {
        return $this->{self::FIELD_COD_AMOUNT};
    }

    public function setCodAmount(float $codAmount): void
    {
        $this->{self::FIELD_COD_AMOUNT} = $codAmount;
    }

    public function getPieceTotal(): int
    {
        return $this->{self::FIELD_PIECE_TOTAL};
    }

    public function setPieceTotal(int $pieceTotal): void
    {
        $this->{self::FIELD_PIECE_TOTAL} = $pieceTotal;
    }

    public function getReceiverContact(): array
    {
        return $this->{self::FIELD_RECEIVER_CONTACT};
    }

    public function setReceiverContact(AddressInterface|array $customerReference): void
    {
        $this->{self::FIELD_RECEIVER_CONTACT} = $customerReference;
    }
}
