<?php

declare(strict_types=1);

namespace App\Models\Api;

interface OrderItemInterface
{
    public const FIELD_NAME = 'name';
    public const FIELD_PRICE = 'price';
    public const FIELD_SKU = 'sku';
    public const FIELD_EAN = 'ean';
    public const FIELD_QTY = 'qty';

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param float $price
     *
     * @return void
     */
    public function setPrice(float $price): void;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param string $sku
     *
     * @return void
     */
    public function setSku(string $sku): void;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @param string $ean
     *
     * @return void
     */
    public function setEan(string $ean): void;

    /**
     * @return string
     */
    public function getEan(): string;

    /**
     * @param float $qty
     *
     * @return void
     */
    public function setQty(float $qty): void;

    /**
     * @return float
     */
    public function getQty(): float;
}
