<?php
declare(strict_types=1);

namespace App\Models\Api\Client\Request;

use App\Models\Api\AddressInterface;

interface CreateShipmentInterface
{
    public const FIELD_BRAND_ID = 'brand_id';
    public const FIELD_REFERENCE = 'reference';
    public const FIELD_WEIGHT = 'weight';
    public const FIELD_PRODUCT_ID = 'product_id';
    public const FIELD_PRODUCT_COMBINATION_ID = 'product_combination_id';
    public const FIELD_COD_AMOUNT = 'cod_amount';
    public const FIELD_PIECE_TOTAL = 'piece_total';
    public const FIELD_RECEIVER_CONTACT = 'receiver_contact';
    public const FIELD_RECEIVER_CONTACT_COMPANYNAME = 'companyname';
    public const FIELD_RECEIVER_CONTACT_NAME = 'name';
    public const FIELD_RECEIVER_CONTACT_STREET = 'street';
    public const FIELD_RECEIVER_CONTACT_HOUSENUMBER = 'housenumber';
    public const FIELD_RECEIVER_CONTACT_POSTALCODE = 'postalcode';
    public const FIELD_RECEIVER_CONTACT_LOCALITY = 'locality';
    public const FIELD_RECEIVER_CONTACT_COUNTRY = 'country';
    public const FIELD_RECEIVER_CONTACT_EMAIL = 'email';
    public const ARRAY_FIELDS = [
        self::FIELD_BRAND_ID,
        self::FIELD_REFERENCE,
        self::FIELD_WEIGHT,
        self::FIELD_PRODUCT_ID,
        self::FIELD_PRODUCT_COMBINATION_ID,
        self::FIELD_COD_AMOUNT,
        self::FIELD_PIECE_TOTAL,
        self::FIELD_RECEIVER_CONTACT,
    ];
    //{"id":"ad3e7f73-37de-48aa-aeb0-b20a11d064b4","token":"6ffa440d-10f4-4d96-b448-82daf8a1375c","created":"2024-11-14T19:58:58+01:00","shipments":[{"id":"35032c48-e2d1-4dfc-b0ac-b4a862a814e5","barcode":"3SQLW0022114441","tracking_url":"https:\/\/goparcel.nl\/track\/3SQLW0022114441\/NL\/2562XK","shop_integration_id":null,"product":{"customs_declaration_type":"document","has_custom_document":false,"has_label":true,"has_zpl_label":true},"delivery_contact":{"country":"NL","country_detail":{"eu_tax":true}},"cubic_volume":0}],"labels":{"a4":{"offset_0":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.pdf?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&offset=0&size=a4","offset_1":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.pdf?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&offset=1&size=a4","offset_2":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.pdf?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&offset=2&size=a4","offset_3":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.pdf?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&offset=3&size=a4"},"a6":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.pdf?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&size=a6","a6_zpl":"https:\/\/api.pakketdienstqls.nl\/pdf\/labels\/ad3e7f73-37de-48aa-aeb0-b20a11d064b4.zpl?token=6ffa440d-10f4-4d96-b448-82daf8a1375c&size=a6"}}

    /**
     * @return string
     */
    public function getBrandId(): string;

    /**
     * @return string
     */
    public function getReference(): string;

    /**
     * @param string $reference
     *
     * @return void
     */
    public function setReference(string $reference): void;

    /**
     * @return float
     */
    public function getWeight(): float;

    /**
     * @param float $weight
     *
     * @return void
     */
    public function setWeight(float $weight): void;

    /**
     * @return int
     */
    public function getProductId(): int;

    /**
     * @param int $productId
     *
     * @return void
     */
    public function setProductId(int $productId): void;

    /**
     * @return int
     */
    public function getProductCombinationId(): int;

    /**
     * @param int $productCombinationId
     *
     * @return void
     */
    public function setProductCombinationId(int $productCombinationId): void;

    /**
     * @return float
     */
    public function getCodAmount(): float;

    /**
     * @param float $codAmount
     *
     * @return void
     */
    public function setCodAmount(float $codAmount): void;

    /**
     * @return int
     */
    public function getPieceTotal(): int;

    /**
     * @param int $pieceTotal
     *
     * @return void
     */
    public function setPieceTotal(int $pieceTotal): void;

    /**
     * @return array
     */
    public function getReceiverContact(): array;

    /**
     * @param AddressInterface|array $customerReference
     *
     * @return void
     */
    public function setReceiverContact(AddressInterface|array $customerReference): void;
}
