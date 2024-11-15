<?php

namespace App\Models;

use App\Models\Api\AddressInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model implements AddressInterface
{
    protected $fillable = [
        self::FIELD_TYPE,
        self::FIELD_COMPANY_NAME,
        self::FIELD_NAME,
        self::FIELD_EMAIL,
        self::FIELD_PHONE,
        self::FIELD_STREET,
        self::FIELD_HOUSENUMBER,
        self::FIELD_ADDRESS_LINE_2,
        self::FIELD_ZIPCODE,
        self::FIELD_CITY,
        self::FIELD_COUNTRY,
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order()->first();
    }

    /**
     * @return string
     */
    public function getFormattedAddress(): string
    {
        $addressParts = [
            $this->getStreet() . ' ' . $this->getHousenumber(),
            $this->getAddressLine2(),
            $this->getZipcode(),
        ];

        $addressParts = array_filter($addressParts);

        return implode(', ', $addressParts);
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->{self::FIELD_TYPE};
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type): void
    {
        $this->{self::FIELD_TYPE} = $type;
    }

    /**
     * @inheritDoc
     */
    public function getCompanyName(): string
    {
        return $this->{self::FIELD_COMPANY_NAME};
    }

    /**
     * @inheritDoc
     */
    public function setCompanyName(string $companyName): void
    {
        $this->{self::FIELD_COMPANY_NAME} = $companyName;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->{self::FIELD_NAME};
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): void
    {
        $this->{self::FIELD_NAME} = $name;
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string
    {
        return $this->{self::FIELD_EMAIL};
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email): void
    {
        $this->{self::FIELD_EMAIL} = $email;
    }

    /**
     * @inheritDoc
     */
    public function getPhone(): string
    {
        return $this->{self::FIELD_PHONE};
    }

    /**
     * @inheritDoc
     */
    public function setPhone(string $phone): void
    {
        $this->{self::FIELD_PHONE} = $phone;
    }

    /**
     * @inheritDoc
     */
    public function getStreet(): string
    {
        return $this->{self::FIELD_STREET};
    }

    /**
     * @inheritDoc
     */
    public function setStreet(string $street): void
    {
        $this->{self::FIELD_STREET} = $street;
    }

    /**
     * @inheritDoc
     */
    public function getHousenumber(): string
    {
        return $this->{self::FIELD_HOUSENUMBER};
    }

    /**
     * @inheritDoc
     */
    public function setHouseNumber(string $houseNumber): void
    {
        $this->{self::FIELD_HOUSENUMBER} = $houseNumber;
    }

    /**
     * @inheritDoc
     */
    public function getAddressLine2(): string
    {
        return $this->{self::FIELD_ADDRESS_LINE_2};
    }

    /**
     * @inheritDoc
     */
    public function setAddressLine2(string $addressLine2): void
    {
        $this->{self::FIELD_ADDRESS_LINE_2} = $addressLine2;
    }

    /**
     * @inheritDoc
     */
    public function getZipcode(): string
    {
        return $this->{self::FIELD_ZIPCODE};
    }

    /**
     * @inheritDoc
     */
    public function setZipcode(string $zipcode): void
    {
        $this->{self::FIELD_ZIPCODE} = $zipcode;
    }

    /**
     * @inheritDoc
     */
    public function getCity(): string
    {
        return $this->{self::FIELD_CITY};
    }

    /**
     * @inheritDoc
     */
    public function setCity(string $city): void
    {
        $this->{self::FIELD_CITY} = $city;
    }

    /**
     * @inheritDoc
     */
    public function getCountry(): string
    {
        return $this->{self::FIELD_COUNTRY};
    }

    /**
     * @inheritDoc
     */
    public function setCountry(string $country): void
    {
        $this->{self::FIELD_COUNTRY} = $country;
    }

    /**
     * @return string
     */
    public function getCountryLabel(): string
    {
        $countries = Shipment::getShippingCountries();
        return $countries[$this->getCountry()];
    }
}
