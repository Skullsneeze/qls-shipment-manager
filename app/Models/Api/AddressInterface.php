<?php

declare(strict_types=1);

namespace App\Models\Api;

interface AddressInterface
{
    public const FIELD_TYPE = 'type';
    public const FIELD_COMPANY_NAME = 'company_name';
    public const FIELD_NAME = 'name';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PHONE = 'phone';
    public const FIELD_STREET = 'street';
    public const FIELD_HOUSENUMBER = 'housenumber';
    public const FIELD_ADDRESS_LINE_2 = 'address_line_2';
    public const FIELD_ZIPCODE = 'zipcode';
    public const FIELD_CITY = 'city';
    public const FIELD_COUNTRY = 'country';

    public const TYPE_SHIPPING = 'shipping';
    public const TYPE_BILLING = 'billing';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type): void;

    /**
     * @return string
     */
    public function getCompanyName(): string;

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     */
    public function setEmail(string $email): void;

    /**
     * @return string
     */
    public function getPhone(): string;

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void;

    /**
     * @return string
     */
    public function getStreet(): string;

    /**
     * @param string $street
     */
    public function setStreet(string $street): void;

    /**
     * @return string
     */
    public function getHousenumber(): string;

    /**
     * @param string $housenumber
     */
    public function setHousenumber(string $housenumber): void;

    /**
     * @return string
     */
    public function getAddressLine2(): string;

    /**
     * @param string $addressLine2
     */
    public function setAddressLine2(string $addressLine2): void;

    /**
     * @return string
     */
    public function getZipcode(): string;

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode): void;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $city
     */
    public function setCity(string $city): void;

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $country
     */
    public function setCountry(string $country): void;
}
