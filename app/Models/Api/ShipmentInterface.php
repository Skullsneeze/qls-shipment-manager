<?php

declare(strict_types=1);

namespace App\Models\Api;

interface ShipmentInterface
{
    public const FIELD_ORDER_ID = 'order_id';
    public const FIELD_QLS_ID = 'qls_id';
    public const FIELD_QLS_TOKEN = 'qls_token';
    public const FIELD_PACKING_SLIP = 'packing_slip';

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @param int $orderId
     *
     * @return void
     */
    public function setOrderId(int $orderId): void;

    /**
     * @return string
     */
    public function getQlsId(): string;

    /**
     * @param string $qlsId
     *
     * @return void
     */
    public function setQlsId(string $qlsId): void;

    /**
     * @return string
     */
    public function getQlsToken(): string;

    /**
     * @param string $qlsToken
     *
     * @return void
     */
    public function setQlsToken(string $qlsToken): void;

    /**
     * @return string|null
     */
    public function getPackingSlip(): ?string;

    /**
     * @param string $packingSlip
     *
     * @return void
     */
    public function setPackingSlip(string $packingSlip): void;
}
