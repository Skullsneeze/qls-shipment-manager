<?php
declare(strict_types=1);

namespace App\Models\Api\Client\Response;

use App\Models\Api\AddressInterface;

interface CreateShipmentInterface
{


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
