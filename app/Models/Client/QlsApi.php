<?php
declare(strict_types=1);

namespace App\Models\Client;

use App\Models\Client\Request\CreateShipment;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class QlsApi
{
    /**
     * Default shipment values
     */
    public const DEFAULT_SHIPMENT_METHOD_ID = 2;
    public const DEFAULT_SHIPMENT_METHOD_LABEL = 'DHL Pakje (NL)';
    public const DEFAULT_SHIPMENT_METHOD_OPTION_ID = 3;
    public const DEFAULT_SHIPMENT_METHOD_OPTION_LABEL = 'Standaard verzending';

    /**
     * API Endpoints
     */
    private const GET_SHIPPING_METHODS_ENDPOINT = '/company/{companyId}/product';
    private const CREATE_SHIPMENT_ENDPOINT = '/company/{companyId}/shipment/create';

    /**
     * Label Endpoints
     */
    private const GET_A4_LABEL = '/pdf/labels/{shipmentId}.pdf?token={token}&offset=3&size=a4';
    private const GET_A6_LABEL = '/pdf/labels/{shipmentId}.pdf?token={token}&size=a6';

    /**
     * Label sizes
     */
    public const LABEL_SIZE_A4 = 'a4';
    public const LABEL_SIZE_A6 = 'a6';

    /**
     * @param CreateShipment $shipmentRequest
     *
     * @return Response
     * @throws ConnectionException
     */
    public function createShipment(CreateShipment $shipmentRequest): Response
    {
        $request = $this->getBaseRequest();
        $uri = $this->addCompanyId(self::CREATE_SHIPMENT_ENDPOINT);

        return $request->post(
            $uri,
            $shipmentRequest->toArray()
        );
    }

    /**
     * @param Shipment $shipment
     * @param string $type
     *
     * @return Response
     * @throws ConnectionException
     */
    public function getLabel(Shipment $shipment, string $type = self::LABEL_SIZE_A4): Response
    {
        $request = $this->getBaseRequest();

        switch ($type) {
            case self::LABEL_SIZE_A6:
                $uri = self::GET_A6_LABEL;
                break;
            case self::LABEL_SIZE_A4:
            default:
                $uri = self::GET_A4_LABEL;
                break;
        }

        $uri = $this->addShipmentId($uri, $shipment->getQlsId());
        $uri = $this->addToken($uri, $shipment->getQlsToken());

        return $request->get($uri);
    }

    /**
     * @return Response
     * @throws ConnectionException
     */
    public function getShippingMethods(): Response
    {
        $request = $this->getBaseRequest();
        $uri = $this->addCompanyId(self::GET_SHIPPING_METHODS_ENDPOINT);

        return $request->get($uri);
    }

    /**
     * @return PendingRequest
     */
    protected function getBaseRequest(): PendingRequest
    {
        $request = Http::acceptJson()
            ->contentType('application/json')
            ->throw()
            ->baseUrl($this->baseUrl());

        return $this->authorize($request);
    }

    /**
     * @param PendingRequest $request
     *
     * @return PendingRequest
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        $request->withBasicAuth(
            config('services.qls_api.username'),
            config('services.qls_api.password')
        );
        return $request;
    }

    /**
     * @return string
     */
    private function baseUrl(): string
    {
        return config('services.qls_api.base_url');
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    private function addCompanyId(string $uri): string
    {
        $companyId = config('services.qls_api.company_id');
        return str_replace('{companyId}', $companyId, $uri);
    }

    /**
     * @param string $uri
     * @param string $orderId
     *
     * @return string
     */
    private function addOrderId(string $uri, string $orderId): string
    {
        return str_replace('{orderId}', $orderId, $uri);
    }

    /**
     * @param string $uri
     * @param string $qlsId
     *
     * @return string
     */
    private function addShipmentId(string $uri, string $qlsId): string
    {
        return str_replace('{shipmentId}', $qlsId, $uri);
    }

    /**
     * @param string $uri
     * @param string $token
     *
     * @return string
     */
    private function addToken(string $uri, string $token): string
    {
        return str_replace('{token}', $token, $uri);
    }
}
