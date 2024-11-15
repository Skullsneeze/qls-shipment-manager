<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Api\ShipmentInterface;
use App\Models\Client\QlsApi;
use Barryvdh\Snappy\Facades\SnappyImage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Pdf as PdfToImage;

class Shipment extends Model implements ShipmentInterface
{
    /**
     * @return string[]
     */
    public static function getShippingCountries(): array
    {
        return [
            'NL' => 'Nederland',
            'BE' => 'België',
            'LU' => 'Luxemburg',
            'FR' => 'Frankrijk',
            'DE' => 'Duitsland',
        ];
    }

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
     * @inheritDoc
     */
    public function getOrderId(): int
    {
        return $this->{self::FIELD_ORDER_ID};
    }

    /**
     * @inheritDoc
     */
    public function setOrderId(int $orderId): void
    {
        $this->{self::FIELD_ORDER_ID} = $orderId;
    }

    /**
     * @inheritDoc
     */
    public function getQlsId(): string
    {
        return $this->{self::FIELD_QLS_ID};
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
    public function getQlsToken(): string
    {
        return $this->{self::FIELD_QLS_TOKEN};
    }

    /**
     * @inheritDoc
     */
    public function setQlsToken(string $qlsToken): void
    {
        $this->{self::FIELD_QLS_TOKEN} = $qlsToken;
    }

    /**
     * @inheritDoc
     */
    public function getPackingSlip(): ?string
    {
        return $this->{self::FIELD_PACKING_SLIP};
    }

    /**
     * @inheritDoc
     */
    public function setPackingSlip(string $packingSlip): void
    {
        $this->{self::FIELD_PACKING_SLIP} = $packingSlip;
    }

    /**
     * @param array $viewData
     * @param string $title
     *
     * @return PdfBuilder
     */
    public function generatePackingSlip(array $viewData, string $title = "Pakbon"): PdfBuilder
    {
        return Pdf::view('pdf.packing-slip', $viewData)
            ->format(Format::A4)
            ->portrait()
            ->name("$title.pdf")
            ->withBrowsershot(function (Browsershot $broadcast) {
                $broadcast->setNodeModulePath(env('NODE_MODULES_PATH'));
                $broadcast->noSandbox();
                $broadcast->pages('1');
            });
    }

    /**
     * @param string $pdfContents
     *
     * @return string
     * @throws PdfDoesNotExist
     */
    public function convertLabelToImage(string $pdfContents): string
    {

        $storage = Storage::disk('public');
        $pdfFilePath = "tmp/label/{$this->getQlsToken()}.pdf";
        $imageFilePath = "tmp/label/{$this->getQlsToken()}.jpg";
        $fullImageFilePath = $storage->path($imageFilePath);

        if ($storage->exists($imageFilePath)) {
            return $fullImageFilePath;
        }

        $storage->put(
            $pdfFilePath,
            $pdfContents
        );

        $labelPdf = new PdfToImage($storage->path($pdfFilePath));
        $labelPdf->save($fullImageFilePath);

        return $fullImageFilePath;
    }

    /**
     * @return string|bool
     * @throws ConnectionException
     * @throws PdfDoesNotExist
     */
    public function getLabelImage(): string|bool
    {
        $imageFilePath = "tmp/label/{$this->getQlsToken()}.jpg";
        $storage = Storage::disk('public');
        if ($storage->exists($imageFilePath)) {
            return $storage->path($imageFilePath);
        }

        $qlsApi = new QlsApi();
        $response = $qlsApi->getLabel($this, QlsApi::LABEL_SIZE_A6);

        return $this->convertLabelToImage($response->body());
    }

    /**
     * @return bool
     */
    public function canHaveLabel(): bool
    {
        return $this->getQlsId() !== ShipmentInterface::NO_LABEL_ID &&
            $this->getQlsToken() !== ShipmentInterface::NO_LABEL_ID;
    }
}
