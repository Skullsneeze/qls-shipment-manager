<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Api\AddressInterface;
use App\Models\Api\OrderInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model implements OrderInterface
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        self::FIELD_NUMBER,
        self::FIELD_QLS_ID
    ];

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items()->get();
    }

    /**
     * @return HasOne
     */
    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class);
    }

    /**
     * @return Shipment|null
     */
    public function getShipment(): ?Shipment
    {
        return $this->shipment()->first();
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses()->get();
    }

    /**
     * @return Address
     */
    public function getShippingAddress(): Address
    {

        return $this->getAddresses()->where(
            AddressInterface::FIELD_TYPE,
            AddressInterface::TYPE_SHIPPING
        )->first();
    }

    /**
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return $this->getAddresses()->where(
            AddressInterface::FIELD_TYPE,
            AddressInterface::TYPE_BILLING
        )->first();
    }

    /**
     * @inheritDoc
     */
    public function setNumber(string $number): void
    {
        $this->{self::FIELD_NUMBER} = $number;
    }

    /**
     * @inheritDoc
     */
    public function getNumber(): string
    {
        return $this->{self::FIELD_NUMBER};
    }

    /**
     * @inheritDoc
     */
    public function setTotalAmount(float $totalAmount): void
    {
        $this->{self::FIELD_TOTAL_AMOUNT} = $totalAmount;
    }

    /**
     * @inheritDoc
     */
    public function getTotalAmount(): float
    {
        return $this->{self::FIELD_TOTAL_AMOUNT};
    }

    /**
     * @inheritDoc
     */
    public function setQlsId(string $qlsId): void
    {
        $this->{self::FIELD_QLS_ID} = $qlsId;
    }

    /**
     * @inheritDoc
     */
    public function getQlsId(): ?string
    {
        return $this->{self::FIELD_QLS_ID};
    }

    /**
     * @return array
     */
    public function toApiDataArray(): array
    {
        return [
            'reference' => $this->getNumber(),
            'weight' => fake()->numberBetween('1', '2000'),
            'cod_amount' => 0,
            'piece_total' => 1,
            'receiver_contact' => $this->getShippingAddress()->toApiDataArray()
        ];
    }
}
