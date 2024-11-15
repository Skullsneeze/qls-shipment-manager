<?php

declare(strict_types=1);

namespace App\Models\Api;

interface OrderInterface
{
    public const FIELD_NUMBER = 'number';
    public const FIELD_TOTAL_AMOUNT = 'total_amount';
    public const FIELD_QLS_ID = 'qls_id';

    /**
     * @param string $number
     *
     * @return void
     */
    public function setNumber(string $number): void;

    /**
     * @return string
     */
    public function getNumber(): string;

    /**
     * @param float $totalAmount
     *
     * @return void
     */
    public function setTotalAmount(float $totalAmount): void;

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @param string $qlsId
     *
     * @return void
     */
    public function setQlsId(string $qlsId): void;

    /**
     * @return string|null
     */
    public function getQlsId(): ?string;
}
