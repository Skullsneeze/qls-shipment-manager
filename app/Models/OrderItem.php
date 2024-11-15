<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Api\OrderItemInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model implements OrderItemInterface
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_SKU,
        self::FIELD_EAN,
        self::FIELD_QTY,
    ];

    /**
     * @var array
     */
    protected $attributes = [
        self::FIELD_QTY => 1
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
     * @inheritDoc
     */
    public function setName(string $name): void
    {
        $this->{self::FIELD_NAME} = $name;
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
    public function setPrice(float $price): void
    {
        $this->{self::FIELD_PRICE} = $price;
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): float
    {
        return $this->{self::FIELD_PRICE};
    }

    /**
     * @inheritDoc
     */
    public function setSku(string $sku): void
    {
        $this->{self::FIELD_SKU} = $sku;
    }

    /**
     * @inheritDoc
     */
    public function getSku(): string
    {
        return $this->{self::FIELD_SKU};
    }

    /**
     * @inheritDoc
     */
    public function setEan(string $ean): void
    {
        $this->{self::FIELD_EAN} = $ean;
    }

    /**
     * @inheritDoc
     */
    public function getEan(): string
    {
        return $this->{self::FIELD_EAN};
    }

    /**
     * @inheritDoc
     */
    public function setQty(float $qty): void
    {
        $this->{self::FIELD_QTY} = $qty;
    }

    /**
     * @inheritDoc
     */
    public function getQty(): float
    {
        return $this->{self::FIELD_QTY};
    }
}
